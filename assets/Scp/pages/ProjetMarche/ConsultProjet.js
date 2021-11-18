import axios from 'axios';
import React, { useEffect, useState } from 'react';
import ReactHtmlTableToExcel from 'react-html-table-to-excel';
import { toast } from "react-toastify";
import OuvriExerc from '../../../Sbu/pages/Exercice/OuvriExerc';
import Pagination from "../../../zforms/Pagination";
import ProjetAPI from '../../../zservices/projetAPI';

const ConsultProjet = ({history}) => {
 
  const [projets, setProjets] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [search, setSearch] = useState("");
  const [proj, setProj] = useState([]);
  const [load, setLoad] = useState(true);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/projets")
      .then(response => response.data["hydra:member"])
      .then(data => setProjets(data));
  }, []);

  const handleDelete = async (id) => {
    const originalProjets = [...projets];
    setProjets(projets.filter((projet) => projet.id !== id));
    try {
      await ProjetAPI.delete(id)
      toast.success("Projet supprimée");
    } catch (error) {
      setProjets(originalprojets);
      toast.error("Projet non supprimée");
    }
  };

    //gestion de la modifification
    const handleModif = (id) => {
      history.replace(`/sbu/projets/${id}`);
    };
    
   //affichage des données d'une projetclature
    const handleView = (id) => {
         axios
        .get(`http://localhost:8000/api/projets/${id}`)
        .then(response => { setProj(response.data);
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
  
    //filtrage des projetclatures en fonctions de la recherche
    const filteredProjets = projets.filter(
      (n) =>
        n.referenceProjet.toLowerCase().includes(search.toLowerCase()) ||
        n.objetMarche.toLowerCase().includes(search.toLowerCase()) 
    );
  
    //pagination des données
    const paginatedProjets = Pagination.getData(
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
          
      <li><strong>Specificité du projet:</strong> {proj.specificiteProjet}</li>
      <li><strong>Pièce à fournir:</strong> {proj.pieceFournir}</li>
      <li><strong>Prix du dossier:</strong> {proj.prixDossier.toLocaleString('fr-FR', {style: 'currency', currency: 'XAF'})}</li>
      <li><strong>propositionMinimum:</strong> {proj.propositionMinimum.toLocaleString('fr-FR', {style: 'currency', currency: 'XAF'})} </li>
      <li><strong>Mode de passation:</strong> {proj.modePassation} </li>

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
            Projet de marché
            </div>
            <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link f-18 p-b-0"
                href="#/scp/projet-marche/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link active f-18 p-b-0"
                 href="#/scp/projet-marche"
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
        <h5 className="card-header-text">Listes des projets de marché</h5>
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
             <th>Numéro de priorité</th>
             <th>Numéro du projet </th>
             <th>objetMarche</th>
             <th>Montant du projet</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
            {paginatedProjets.map(projet =>
                        <tr key={projet.id} value={projet.id}>
                        <td>{projet.prioriteProjet}</td>
                        <td>{projet.numeroProjet}</td>
                        <td>{projet.objetMarche}</td>
                        <td>{projet.montantProjet.toLocaleString('fr-FR', {style: 'currency', currency: 'XAF'})} </td>
                        <td>
                                <button
                                  onClick={() => handleDelete(projet.id)}
                                  className="m-r-15 btn btn-sm btn-danger btn-icon"
                                  disabled={
                                    projet.associationLot.length > 0
                                  }
                                >
                                  <i className="fa fa-trash"></i>
                                </button>
                                <button
                                  disabled={
                                    projet.associationLot.length > 0
                                  }
                                  onClick={() => handleModif(projet.id)}
                                  className="m-r-15 btn btn-sm btn-primary btn-icon"
                                >
                                  <i className="fa fa-edit"></i>
                                </button>

                                <button
                                  onClick={() => handleView(projet.id)}
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
   {itemsPerPage < filteredProjets.length && (
                    <Pagination
                      currentPage={currentPage}
                      itemsPerPage={itemsPerPage}
                      length={filteredProjets.length}
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

export default ConsultProjet;