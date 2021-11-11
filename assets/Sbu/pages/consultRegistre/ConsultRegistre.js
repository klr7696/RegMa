import axios from "axios";
import moment from "moment";
import React, { useEffect, useState } from "react";
import { toast } from "react-toastify";
import Pagination from "../../../zforms/Pagination";
import NomenAPI from "../../../zservices/nomenAPI";

const ConsultRegistre = ({ history }) => {

  const [registres, setRegistres] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [search, setSearch] = useState("");
  const [registr, setRegistr] = useState([]);
  const [load, setLoad] = useState(true);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/resgitres/1/ressources")
      .then(response => response.data["hydra:member"])
      .then(data => setRegistres(data));
  }, []);

 //affichage des données d'une nomenclature
  const handleView = (id) => {
       axios
      .get(`http://localhost:8000/api/nomenclatures/${id}`)
      .then(response => { setRegistr(response.data);
        setLoad(false);
      })
     .catch(error => console.log(error) ) 
    }
    //formatage de date en francais
  //const formatDate = (str) => moment(str).format('DD/MM/YYYY');

  //gestion du chargement
  const handleChangePage = (page) => setCurrentPage(page);

  //gestion de la recherche
  const handleSearch = ({currentTarget}) => {
    setSearch(currentTarget.value);
    setCurrentPage(1);
  };

  const itemsPerPage = 5;

  //filtrage des nomenclatures en fonctions de la recherche
  const filteredRegistres = registres.filter(
    (n) =>
      n.bailleurFonds.toLowerCase().includes(search.toLowerCase()) ||
      n.objetFinancement.toLowerCase().includes(search.toLowerCase())
  );

  //pagination des données
  const paginatedRegistres = Pagination.getData(
    filteredRegistres,
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
                             <h5>Status du Registre</h5>
                             <p>{registr.statutRegistre.statut}</p>
                                <h5>Description</h5>
                                  <p>{registr.descriptionFinancement}</p>
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
        <h3 className="card-header">
          <div className="row">
            <div className="text-left col-sm-6">Registre</div>
            <div className="text-right col-sm-6">
              <button className="btn-sm btn-secondary"></button>
            </div>
          </div>
        </h3>
        <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
          <li className="nav-item m-b-0">
            <a className="nav-link active f-18 p-b-0" 
            href="#/sbu/registres-ressources"
            >
              Ressources financières
            </a>
            <div className="slide" />
          </li>
          <li className="nav-item">
            <a
              className="nav-link f-18 p-b-0"
              href="#/sbu/registres-ouverts"
            >
              Crédits ouverts
            </a>
            <div className="slide" />
          </li>
           <li className="nav-item m-b-0">
            <a className="nav-link f-18 p-b-0" 
            href="#/sbu/registres-alloues">
              Crédits alloués
            </a>
            <div className="slide" />
          </li>
          <li className="nav-item m-b-0">
            <a className="nav-link f-18 p-b-0" 
            href="#/sbu/registres-autorises">
              Crédits autorisés
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
                          Liste de ressources financières
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
                            <th>Objet de financement</th>
                            <th>Mode de financement</th>
                            <th>Montant de financement</th>
                            <th>Bailleur de fonds</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {paginatedRegistres.map((registre) => (
                            <tr key={registre.id}>
                              <td>{registre.id}</td>
                              <td>{registre.objetFinancement}</td>
                              <td>{registre.modeFinancement}</td>
                              <td>{registre.montantFinancement}</td>
                              <td>{registre.bailleurFonds.sigleBailleur}</td>
                              <td>
                                <button
                                  onClick={() => handleView(registre.id)}
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
                  {itemsPerPage < filteredRegistres.length && (
                    <Pagination
                      currentPage={currentPage}
                      itemsPerPage={itemsPerPage}
                      length={filteredRegistres.length}
                      onPageChanged={handleChangePage}
                    />
                  )}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     <div>
       {resultModal}
</div>

    </section>
  );
};
export default ConsultRegistre;
