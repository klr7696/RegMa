import axios from "axios";
import moment from "moment";
import React, { useEffect, useState } from "react";
import { toast } from "react-toastify";
import Pagination from "../../../zforms/Pagination";
import MairieAPI from "../../../zservices/mairieAPI";

const ConsultMairie = ({ history }) => {
  const [mairies, setMairies] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [search, setSearch] = useState("");
  const [mairi, setMairi] = useState([]);
  const [load, setLoad] = useState(true);

  // permet d'aller recuperer les  nomenclatures
  const fetchMairies = async () => {
    try {
      const data = await  MairieAPI.findAll()
      setMairies(data);
      toast.success("liste chargée avec succès");
    } catch(error) {
      console.log(error.response);
    }
  }

  // au chargement du composant, on va chercher les nomenclatures
  useEffect(() =>{ fetchMairies(); }, []);

  //gestion de la suppression
  const handleDelete = async (id) => {
    const originalMairies = [...mairies];
    setMairies(mairies.filter((mairie) => mairie.id !== id));
    try {
      await MairieAPI.delete(id)
      toast.success("Mairie supprimée");
    } catch (error) {
      setMairies(originalMairies);
      toast.error("Mairie non supprimée");
    }
  };

  //gestion de la modifification
  const handleModif = (id) => {
    history.replace(`/sbu/mairies/${id}`);
    toast.info("Modification d'une mairie");
  };
  
 //affichage des données d'une nomenclature
  const handleView = (id) => {
       axios
      .get(`http://localhost:8000/api/mairies/${id}`)
      .then(response => { setMairi(response.data);
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

  //filtrage des mairies en fonctions de la recherche
  const filteredMairies = mairies.filter(
    (n) =>
      n.designationMairie.toLowerCase().includes(search.toLowerCase()) ||
      n.abbreviationMairie.toLowerCase().includes(search.toLowerCase())
  );

  //pagination des données
  const paginatedMairies = Pagination.getData(
    filteredMairies,
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
                              <h5>Adresse Mairie </h5>
                             <p>{mairi.adresseMairie}</p>
                                <h5>Description</h5>
                                  <p>{mairi.descriptionMairie}</p>
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
            <div className="text-left col-sm-6">Mairie communale</div>
            <div className="text-right col-sm-6">
              <button className="btn-sm btn-secondary">{}</button>
            </div>
          </div>
        </h3>
        <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
          <li className="nav-item m-b-0">
            <a className="nav-link f-18 p-b-0" href="#/admin/mairies/new">
              Enregistrement
            </a>
            <div className="slide" />
          </li>
          <li className="nav-item">
            <a
              className="nav-link active f-18 p-b-0"
              href="#/admin/mairies"
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
                          Liste de mairies communales
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
                            <th>Désignation </th>
                            <th>Abbreviation</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
         
                          {paginatedMairies.map((mairie) => (
                            <tr key={mairie.id}>
                              <td>{mairie.id}</td>
                              <td>{mairie.designationMairie}</td>
                              <td>{mairie.abbreviationMairie}</td>
                              <td>
                                <button
                                  onClick={() => handleDelete(mairie.id)}
                                  className="m-r-20 btn btn-sm btn-danger "
                                  disabled={
                                    mairie.length > 0
                                  }
                                >
                                  <i className="fa fa-trash"></i>
                                </button>
                                <button
                                  disabled={
                                    mairie.length > 0
                                  }
                                  onClick={() => handleModif(mairie.id)}
                                  className="m-r-20 btn btn-sm btn-primary"
                                >
                                  <i className="fa fa-edit"></i>
                                </button>

                                <button
                                  onClick={() => handleView(mairie.id)}
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
                  {itemsPerPage < filteredMairies.length && (
                    <Pagination
                      currentPage={currentPage}
                      itemsPerPage={itemsPerPage}
                      length={filteredMairies.length}
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
export default ConsultMairie;
