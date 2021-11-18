import axios from 'axios';
import React, { useEffect, useState } from 'react';
import ReactHtmlTableToExcel from 'react-html-table-to-excel';
import { toast } from "react-toastify";
import OuvriExerc from '../../../Sbu/pages/Exercice/OuvriExerc';
import Pagination from "../../../zforms/Pagination";
import lotAPI from '../../../zservices/lotAPI';

const ConsultLot = ({history}) => {
 
  const [lots, setLots] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [search, setSearch] = useState("");
  const [lotM, setlotM] = useState([]);
  const [load, setLoad] = useState(true);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/lots")
      .then(response => response.data["hydra:member"])
      .then(data => setLots(data));
  }, []);

  const handleDelete = async (id) => {
    const originalLots = [...lots];
    setLots(lots.filter((lot) => lot.id !== id));
    try {
      await lotAPI.delete(id)
      toast.success("lot supprimée");
    } catch (error) {
      setLots(originalLots);
      toast.error("lot non supprimée");
    }
  };

    //gestion de la modifification
    const handleModif = (id) => {
      history.replace(`/sbu/lots/${id}`);
    };
    
   //affichage des données d'une lotclature
    const handleView = (id) => {
         axios
        .get(`http://localhost:8000/api/lots/${id}`)
        .then(response => { setLotM(response.data);
          setLoad(false);
        })
       .catch(error => console.log(error) ) 
      }
      //formatage de date en francais
    const formatDate = (str) => moment(str).format('DD/MM/YYYY');
  
    //gestion du chargement
    const handleChangePage = (page) => setCurrentPage(page);
  
    //gestion de la recherche
    const handleSearch = ({currentTarget}) => {
      setSearch(currentTarget.value);
      setCurrentPage(1);
    };
  
    const itemsPerPage = 5;
  
    //filtrage des lotclatures en fonctions de la recherche
    const filteredLots = lots.filter(
      (n) =>
        n.objetLot.toLowerCase().includes(search.toLowerCase()) 
    );
  
    //pagination des données
    const paginatedLots = Pagination.getData(
      filteredLots,
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
          <ul>
      <li><strong>Objet du lot:</strong> {lotM.objetLot}</li>   
      <li><strong>Observation du lot:</strong> {lotM.observationLot}</li>
      <li><strong>Plan de passation:</strong> {lotM.planPassation}</li>
      <li><strong>Autorisation du marché:</strong> {lotM.autorisationMarche}</li>
      <li><strong>Projet de marché:</strong> {lotM.projetMarche} </li>

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
            Lot de marché
            </div>
            <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link f-18 p-b-0"
                href="#/scp/lot-marche/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link active f-18 p-b-0"
                 href="#/scp/lot-marche"
              >
                Consultation
              </a>
              <div className="slide" />
            </li>
          </ul>
          <div className="card">
        <div className="card-block">
          <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
        <div className="card-block">
        <div className="row form-group">
                      <div className="text-left col-sm-9">
        <h5 className="card-header-text">Listes des lots de marché</h5>
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
        <div className="dt-responsive table-responsive">
                    <ReactHtmlTableToExcel
                    id="test-table-xls-button"
                    className="download-table-xls-button btn-sm btn-success mb-3"
                    table="table-to-xls"
                    filename="tablexls"
                    sheet="tablexls"
                    buttonText="Exporter en Excel"/>
                   <table className="table" id="table-to-xls">
                        <thead className="thead-dark">
           <tr>
             <th>Numéro du lot </th>
             <th>Montant du lot</th>
             <th>Délais d'exécution</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
            {paginatedLots.map(lot =>
                        <tr key={lot.id} value={lot.id}>
                        <td>{lot.numeroLot}</td>
                        <td>{lot.montantLot.toLocaleString('fr-FR', {style: 'currency', currency: 'XAF'})} </td>
                        <td>{lot.delaiExecution} jours</td>
                        <td>
                                <button
                                  onClick={() => handleDelete(lot.id)}
                                  className="m-r-15 btn btn-sm btn-danger btn-icon"
                                  disabled={
                                    lot.associationOffre.length > 0
                                  }
                                >
                                  <i className="fa fa-trash"></i>
                                </button>
                                <button
                                  disabled={
                                    lot.associationOffre.length > 0
                                  }
                                  onClick={() => handleModif(lot.id)}
                                  className="m-r-15 btn btn-sm btn-primary btn-icon"
                                >
                                  <i className="fa fa-edit"></i>
                                </button>

                                <button
                                  onClick={() => handleView(lot.id)}
                                  className="btn btn-sm btn-icon btn-secondary "
                                  data-toggle="modal" data-target="#large-Modal"
                                >
                                  <i className="fa fa-eye"></i>
                                </button>
                              </td>
              </tr>)}
            </tbody>
       </table>
     </div>
   </div>
   {itemsPerPage < filteredLots.length && (
                    <Pagination
                      currentPage={currentPage}
                      itemsPerPage={itemsPerPage}
                      length={filteredLots.length}
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

export default ConsultLot;
