import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { toast } from 'react-toastify';
import Pagination from '../../../zforms/Pagination';
import AutoriseAPI from '../../../zservices/autoriseAPI';
import OuvriExerc from '../Exercice/OuvriExerc';

const ConsultAutoris = ({history}) => {
  const [autorises, setAutorises] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [search, setSearch] = useState("");
  const [autori, setAutori] = useState([]);
  const [load, setLoad] = useState(true);

  // permet d'aller recuperer les  credits
  const fetchAutorises = async () => {
    try {
      const data = await  AutoriseAPI.findAll()
      setAutorises(data);
      toast.success("liste chargée avec succès");
    } catch(error) {
      console.log(error);
    }
  }

  // au chargement du composant, on va chercher les credits
  useEffect(() =>{ fetchAutorises(); }, []);

  //gestion de la modifification
  const handleModif = (id) => {
    history.replace(`/sbu/credit-autorise/${id}`);
    toast.info("Modification d'une autorisation ");
  };
  
 //affichage des données d'une credit
  const handleView = (id) => {
       axios
      .get(`http://localhost:8000/api/autorisations/${id}`)
      .then(response => { setAutori(response.data);
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
  const filteredAutorises = autorises.filter(
    (n) =>
     n.objetAutorisation.toLowerCase().includes(search.toLowerCase())
  );

  //pagination des données
  const paginatedAutorises = Pagination.getData(
    filteredAutorises,
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
        <h5 className="modal-title">Infos supplémentaires</h5>
        </div>
        <div className="modal-body">
    <ul>
      <li><strong>Montant du crédit ouvert:</strong> {autori.montantInscription}</li>
      <li><strong>Bailleur de Fond:</strong> {autori.sigleBailleur}</li>
      <li><strong>Mairie:</strong> {autori.mairieCommunale}</li>
      <li><strong>Explication de l'autorisation:</strong> {autori.explicationAutorisation} </li>
      <li><strong>est Actualisée?:</strong> {(!autori.estValide==true && <>Oui</>) || (<>Non</>)}</li>
    </ul>
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
            Crédit autorisé
            </div>
            <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/credit-autorise/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
    
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/red-autorise"
              >
                Actualisation
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link active f-18 p-b-0"
                href="#/sbu/credit-autorise"
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
                          Liste de crédits autorisés
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
                            <th>Objet de l'autorisation</th>
                            <th>Montant de l'autorisation</th>
                            <th>Compte nature</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {paginatedAutorises.map((autorise) => (
                            <tr key={autorise.id} value={autorise.id}>
                               <td>{autorise.id}</td>
                              <td>{autorise.objetAutorisation}</td>
                              <td>{autorise.montantAutorisation.toLocaleString('fr-FR', {style: 'currency', currency: 'XAF'})}</td>
                              <td>{autorise.compteNature}</td>
                              <td>
                                <button
                                  onClick={() => handleModif(autorise.id)}
                                  className="m-r-20 btn btn-sm btn-primary"
                                >
                                  <i className="fa fa-edit"></i>
                                </button>
                                <button
                                  onClick={() => handleView(autorise.id)}
                                  className="btn btn-icon btn-sm btn-secondary "
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
                  {itemsPerPage < filteredAutorises.length && (
                    <Pagination
                      currentPage={currentPage}
                      itemsPerPage={itemsPerPage}
                      length={filteredAutorises.length}
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

export default ConsultAutoris;