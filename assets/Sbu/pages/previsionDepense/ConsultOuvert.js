import axios from 'axios';
import React, { useEffect, useState } from 'react';
import Pagination from '../../../zforms/Pagination';
import CrediAPI from '../../../zservices/crediAPI';
import OuvriExerc from '../Exercice/OuvriExerc';

const ConsultOuvert = ({history}) => {
  const [creds, setCreds] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [search, setSearch] = useState("");
  const [credi, setCredi] = useState([]);
  const [load, setLoad] = useState(true);

  // permet d'aller recuperer les  credits
  const fetchCreds = async () => {
    try {
      const data = await  CrediAPI.findAll()
      setCreds(data);
      toast.success("liste chargée avec succès");
    } catch(error) {
      console.log(error.response);
    }
  }

  // au chargement du composant, on va chercher les credits
  useEffect(() =>{ fetchCreds(); }, []);

  //gestion de la suppression
  const handleDelete = async (id) => {
    const originalCreds = [...creds];
    setCreds(creds.filter((cred) => cred.id !== id));
    try {
      await NomenAPI.delete(id)
      toast.success("Crédit ouvert supprimé");
    } catch (error) {
      setNomens(originalNomens);
      toast.error("Crédit ouvert non supprimée");
    }
  };

  //gestion de la modifification
  const handleModif = (id) => {
    history.replace(`/sbu/credit-ouvert/${id}`);
    toast.info("Modification d'un crédit ouvert ");
  };
  
 //affichage des données d'une credit
  const handleView = (id) => {
       axios
      .get(`http://localhost:8000/api/ouverts/${id}`)
      .then(response => { setCredi(response.data);
        setLoad(false);
      })
     .catch(error => console.log(error) ) 
    }
  
  //gestion du chargement
  const handleChangePage = (page) => setCurrentPage(page);

  //gestion de la recherche
  const handleSearch = ({currentTarget}) => {
    setSearch(currentTarget.value);
    setCurrentPage(1);
  };

  const itemsPerPage = 5;

  //filtrage des credits en fonctions de la recherche
  const filteredCreds = creds.filter(
    (n) => n
    // n.decriptionInscrption.toLowerCase().includes(search.toLowerCase())
  );

  //pagination des données
  const paginatedCreds = Pagination.getData(
    filteredCreds,
    currentPage,
    itemsPerPage
  );

  //condition d'afichage des données dans le modal
  const resultModal = !load ? 
  (
    <div className="modal fade" id="large-Modal" tabIndex={-1} role="dialog">
    <div className="modal-dialog modal-lg" role="document">
      <div className="modal-content">
        <div className="modal-header">
          <h4 className="modal-title">Infos supplémentaires</h4>
        </div>
        <div className="modal-body">
                              <h5>Montant ressources</h5>
                             <p>{credi.montantFinancement}</p>
                              <h5>Sigle bailleur</h5>
                              <p>{credi.sigleBailleur}</p>
                                <h5>Description</h5>
                                  <p>{credi.descriptionInscription}</p>
        </div>
        <div className="modal-footer">
          <button type="button" className="btn btn-default waves-effect " data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  )
  :
  (
    <div className="modal fade" id="large-Modal" tabIndex={-1} role="dialog">
    <div className="modal-dialog modal-lg" role="document">
      <div className="modal-content">
        <div className="modal-header">
          <h4 className="modal-title">Chargement ...</h4>
        </div>
        <div className="modal-body">
                         <p>Patientez un instant</p>
        </div>
        <div className="modal-footer">
          <button type="button" className="btn btn-default waves-effect " data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  )


    return (
        <section id="exp">
        <div className="product-detail-page">
        <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-8">
            Crédit ouvert
            </div>
            <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/credit-ouvert/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
    
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/red-ouver"
              >
                Actualisation
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item active m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/credit-ouvert"
              >
                Consultation
              </a>
              <div className="slide" />
            </li>
    
          </ul>
          <div className="card">
          <div className="card-block">
            <div className="tab-content bg-white">
              <div
                className="tab-pane active"
                id="consultation"
                role="tabpanel"
              >
                <div className="page-body">
                  <div className="card-block table-border-style">
                    <div className="row form-group">
                      <div className="text-left col-sm-9">
                        <h5 className="card-header-text">
                          Liste de crédits ouverts
                        </h5>
                      </div>
                      <div className=" form-group text-right col-sm-3">
                        <input
                          type="text"
                          onChange={handleSearch}
                          value={search}
                          className="form-control"
                          placeholder="Rechercher ..."
                        />
                      </div>
                    </div>
                    <div className="table-responsive">
                      <table className="table table-bordered">
                        <thead>
                          <tr>
                            <th>id</th>
                            <th>Numéro du comptes</th>
                            <th>Montant</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {paginatedCreds.map((cred) => (
                            <tr key={cred.id}>
                              <td>{cred.id}</td>
                              <td>{cred.compteNature}</td>
                              <td>{cred.montantInscription.toLocaleString('fr-FR', {style: 'currency', currency: 'XAF'})}</td>
                              <td>
                                <button
                                  onClick={() => handleDelete(cred.id)}
                                  className="m-r-20 btn btn-sm btn-danger "
                                  disabled={
                                    cred.associationAllocation.length > 0
                                  }
                                >
                                  <i className="fa fa-trash"></i>
                                </button>
                                <button
                                  disabled={
                                    cred.associationAllocation.length > 0
                                  }
                                  onClick={() => handleModif(cred.id)}
                                  className="m-r-20 btn btn-sm btn-primary"
                                >
                                  <i className="fa fa-edit"></i>
                                </button>
                                <button
                                  onClick={() => handleView(cred.id)}
                                  className="btn btn-sm btn-secondary "
                                  data-toggle="modal" data-target="#large-Modal"
                                >
                                  <i className="fa fa-eye"></i>
                                </button>
                              </td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    </div>
                  </div>
                  {itemsPerPage < filteredCreds.length && (
                    <Pagination
                      currentPage={currentPage}
                      itemsPerPage={itemsPerPage}
                      length={filteredCreds.length}
                      onPageChanged={handleChangePage}
                    />
                  )}
                </div>
              </div>
            </div>
          </div>
        </div>
        {resultModal}
      </div>
    </section>
    );
};

export default ConsultOuvert;