import axios from "axios";
import React, {useState, useEffect } from "react";
import OuvriExerc from "../Exercice/OuvriExerc";
import Pagination from '../../../zforms/Pagination';
import BailleurAPI from '../../../zservices/bailleurAPI';

const ConsultBaill = ({history}) => {

  const [bailleurs, setBailleurs] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [search, setSearch] = useState("");
  const [baill, setBaill] = useState([]);
  const [load, setLoad] = useState(true);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/bailleurs")
      .then(response => response.data["hydra:member"])
      .then(data => setBailleurs(data));
  }, []);

  const handleDelete = async (id) => {
    const originalBailleurs = [...bailleur];
    setBailleurs(bailleurs.filter((bailleur) => bailleur.id !== id));
    try {
      await BailleurAPI.delete(id)
      toast.success("Bailleurs de fonds supprimée");
    } catch (error) {
      setBailleurs(originalFinans);
      toast.error("Bailleurs de fonds non supprimée");
    }
  };

    //gestion de la modifification
    const handleModif = (id) => {
      history.replace(`/sbu/bailleurs/${id}`);
    };
    
   //affichage des données d'une financlature
    const handleView = (id) => {
         axios
        .get(`http://localhost:8000/api/bailleurs/${id}`)
        .then(response => { setBaill(response.data);
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
    const filteredBailleurs = bailleurs.filter(
      (n) =>
        n.sigleBailleur.toLowerCase().includes(search.toLowerCase())
    );
  
    //pagination des données
    const paginatedBailleurs = Pagination.getData(
      filteredBailleurs,
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
      <li><strong>Code du bailleur:</strong> {baill.codeBailleur}</li>
      <li><strong>Source de financement:</strong> {baill.sourceFinancement}</li>
      <li><strong>Description du Bailleur:</strong> {baill.descriptionBailleur} </li>
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
           Bailleur de fonds
            </div>
            <OuvriExerc/>
            </div>
          </h4>
      <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
        <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/bailleurs/new"
          >
            Enregistrement
          </a>
          <div className="slide" />
        </li>
        <li className="nav-item">
          <a
            className="nav-link active f-18 p-b-0"
            href="#/sbu/bailleurs"
          >
            Consultation
          </a>
          <div className="slide" />
        </li>
      </ul>
      <div className="card">
        <div className="card-block">
          <div className="tab-content bg-white">
            <div className="tab-pane active" id="consultation" role="tabpanel">
            <div className="page-body">
      <div className="card-block table-border-style">
        <div className="row form-group">
        <div className="text-left col-sm-9">
        <h5 className="card-header-text">Listes des Bailleurs de fonds</h5>
        </div>
        <div className="text-right col-sm-3">
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
        </div>
      
        <div className="table-responsive">
          <table
           className="table table-bordered"
          >
            <thead>
              <tr>
                <td>id</td>
                <th>Désignation</th>
                <th>Sigle</th>
                <th>Catégorie</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            {paginatedBailleurs.map(bailleur =>
               <tr key={bailleur.id}>
                        <td>{bailleur.id}</td>
                        <td>{bailleur.designationBailleur}</td>
                        <td>{bailleur.sigleBailleur}</td>
                        <td>{bailleur.categorieBailleur}</td>
                        <td>
                                <button
                                  onClick={() => handleDelete(bailleur.id)}
                                  className="m-r-15 btn btn-sm btn-danger btn-icon"
                                >
                                  <i className="fa fa-trash"></i>
                                </button>
                                <button
                                  onClick={() => handleModif(bailleur.id)}
                                  className="m-r-15 btn btn-sm btn-primary btn-icon"
                                >
                                  <i className="fa fa-edit"></i>
                                </button>

                                <button
                                  onClick={() => handleView(bailleur.id)}
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
      {itemsPerPage < filteredBailleurs.length && (
                    <Pagination
                      currentPage={currentPage}
                      itemsPerPage={itemsPerPage}
                      length={filteredBailleurs.length}
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
export default ConsultBaill;
