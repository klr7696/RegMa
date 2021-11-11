import axios from 'axios';
import React, { useEffect, useState } from 'react';
import Pagination from '../../../zforms/Pagination';
import AllocAPI from '../../../zservices/crediAPI';
import OuvriExerc from '../Exercice/OuvriExerc';

const ConsultAlloc = ({history}) => {
  const [allocs, setAllocs] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [search, setSearch] = useState("");
  const [alloca, setAlloca] = useState([]);
  const [load, setLoad] = useState(true);

  // permet d'aller recuperer les  credits
  const fetchAllocs = async () => {
    try {
      const data = await  AllocAPI.findAll()
      setAllocs(data);
      toast.success("liste chargée avec succès");
    } catch(error) {
      console.log(error.response);
    }
  }

  // au chargement du composant, on va chercher les credits
  useEffect(() =>{ fetchAllocs(); }, []);

  //gestion de la suppression
  const handleDelete = async (id) => {
    const originalAllocs = [...creds];
    setAllocs(allocs.filter((alloc) => alloc.id !== id));
    try {
      await AllocAPI.delete(id)
      toast.success("Allocation supprimé");
    } catch (error) {
      setAllocs(originalAllocs);
      toast.error("Allocation non supprimée");
    }
  };

  //gestion de la modifification
  const handleModif = (id) => {
    history.replace(`/sbu/credit-alloue/${id}`);
    toast.info("Modification d'un crédit alloué ");
  };
  
 //affichage des données d'une credit
  const handleView = (id) => {
       axios
      .get(`http://localhost:8000/api/allocations/${id}`)
      .then(response => { setAlloca(response.data);
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
  const filteredAllocs = allocs.filter(
    (n) => n
    // n.decriptionInscrption.toLowerCase().includes(search.toLowerCase())
  );

  //pagination des données
  const paginatedAllocs = Pagination.getData(
    filteredAllocs,
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
                             <p>{alloca.montantFinancement}</p>
                              <h5>Sigle bailleur</h5>
                              <p>{alloca.sigleBailleur}</p>
                                <h5>Description</h5>
                                  <p>{alloca.descriptionInscription}</p>
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
            Crédit alloué
            </div>
            <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/credit-alloue/new"
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
            <li className="nav-item m-b-0">
              <a
                className="nav-link active f-18 p-b-0"
                href="#/sbu/credit-alloue"
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
                          Liste de crédits alloués
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
                            <th>Montant du crédit ouvert</th>
                            <th>Mairie communale</th>
                            <th>Montant du crédit alloué</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {paginatedAllocs.map((alloc) => (
                            <tr key={alloc.id}>
                              <td>{alloc.id}</td>
                              <td>{alloc.id}</td>
                              <td>{alloc.montantInscription.toLocaleString('fr-FR', {style: 'currency', currency: 'XAF'})}</td>
                              <td>{alloc.id}</td>
                              <td>{alloc.montantInscription.toLocaleString('fr-FR', {style: 'currency', currency: 'XAF'})}</td>
                              <td>
                                <button
                                  onClick={() => handleDelete(alloc.id)}
                                  className="m-r-20 btn btn-sm btn-danger "
                                  disabled={
                                    alloc.length > 0
                                  }
                                >
                                  <i className="fa fa-trash"></i>
                                </button>
                                <button
                                  disabled={
                                    alloc.length > 0
                                  }
                                  onClick={() => handleModif(alloc.id)}
                                  className="m-r-20 btn btn-sm btn-primary"
                                >
                                  <i className="fa fa-edit"></i>
                                </button>
                                <button
                                  onClick={() => handleView(alloc.id)}
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
                  {itemsPerPage < filteredAllocs.length && (
                    <Pagination
                      currentPage={currentPage}
                      itemsPerPage={itemsPerPage}
                      length={filteredAllocs.length}
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

export default ConsultAlloc;