import axios from 'axios';
import React, { useEffect, useState } from 'react';
import ReactHtmlTableToExcel from 'react-html-table-to-excel';
import OuvriExerc from '../Exercice/OuvriExerc';
import { toast } from "react-toastify";
import Pagination from "../../../zforms/Pagination";

const ConsultRessource = ({history}) => {
 
  const [finans, setFinans] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [search, setSearch] = useState("");
  const [fina, setFina] = useState([]);
  const [load, setLoad] = useState(true);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/ressources?estValide=true")
      .then(response => response.data["hydra:member"])
      .then(data => setFinans(data));
  }, []);

  const handleDelete = async (id) => {
    const originalFinans = [...finans];
    setFinans(finans.filter((finan) => finan.id !== id));
    try {
      await finanAPI.delete(id)
      toast.success("ressource financière supprimée");
    } catch (error) {
      setfinans(originalFinans);
      toast.error("ressource financière non supprimée");
    }
  };

    //gestion de la modifification
    const handleModif = (id) => {
      history.replace(`/sbu/ressources/${id}`);
    };
    
   //affichage des données d'une financlature
    const handleView = (id) => {
         axios
        .get(`http://localhost:8000/api/ressources/${id}`)
        .then(response => { setFina(response.data);
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
  
    //filtrage des financlatures en fonctions de la recherche
    const filteredFinans = finans.filter(
      (n) =>
        n.objetFinancement.toLowerCase().includes(search.toLowerCase())
    );
  
    //pagination des données
    const paginatedFinans = Pagination.getData(
      filteredFinans,
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
                                <h5>Exercice</h5>
                               <p>{fina.exerciceRegistre} {fina.statutRegistre}</p>
                                <h5>Mode de Financement</h5>
                                <p>{fina.modeFinancement}</p>
                                  <h5>Description</h5>
                                    <p>{fina.descriptionFinancement}</p>
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
            Ressource financière 
            </div>
            <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link f-18 p-b-0"
                href="#/sbu/ressources/new"
              >
                Inscription
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link active f-18 p-b-0"
                 href="#/sbu/ressources"
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
        <h5 className="card-header-text">Listes des financements</h5>
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
              <th>id</th>
             <th>Bailleur</th>
             <th>Objet</th>
             <th>Mode</th>
             <th>Montant</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
            {paginatedFinans.map(finan =>
                        <tr key={finan.id} value={finan.id}>
                        <td>{finan.id}</td>
                        <td>{finan.bailleurFonds}</td>
                        <td>{finan.objetFinancement}</td>
                        <td>{finan.modeFinancement} </td>
                        <td>{finan.montantFinancement.toLocaleString('fr-FR', {style: 'currency', currency: 'XAF'})}</td>
                        <td>
                                <button
                                  onClick={() => handleDelete(finan.id)}
                                  className="m-r-15 btn btn-sm btn-danger btn-icon"
                                  disabled={
                                    finan.associationCredit.length > 0
                                  }
                                >
                                  <i className="fa fa-trash"></i>
                                </button>
                                <button
                                  disabled={
                                    finan.associationCredit.length > 0
                                  }
                                  onClick={() => handleModif(finan.id)}
                                  className="m-r-15 btn btn-sm btn-primary btn-icon"
                                >
                                  <i className="fa fa-edit"></i>
                                </button>

                                <button
                                  onClick={() => handleView(finan.id)}
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
   {itemsPerPage < filteredFinans.length && (
                    <Pagination
                      currentPage={currentPage}
                      itemsPerPage={itemsPerPage}
                      length={filteredFinans.length}
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

export default ConsultRessource;