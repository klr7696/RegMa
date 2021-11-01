import React, { useEffect, useState } from "react";
import { toast } from "react-toastify";
import Pagination from "../../../zforms/Pagination";
import NomenAPI from "../../../zservices/nomenAPI";

const ConsultNomen = ({ history }) => {
  const [nomens, setNomens] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [search, setSearch] = useState("");

  // permet d'aller recuperer les nomenclatures
  const fetchNomens = async () => {
    try {
      const data = await  NomenAPI.findAll()
      setNomens(data);
      toast.success("liste chargée avec succès");
    } catch(error) {
      console.log(error.response);
    }
  }

  // au chargement du composant, on va chercher les nomenclatures
  useEffect(() =>{ fetchNomens(); }, []);

  //gestion de la suppression
  const handleDelete = async (id) => {
    const originalNomens = [...nomens];
    setNomens(nomens.filter((nomen) => nomen.id !== id));
    try {
      await NomenAPI.delete(id)
      toast.success("Nomenclature supprimée");
    } catch (error) {
      setNomens(originalNomens);
      toast.error("Nomenclature non supprimée");
    }
  };

  //gestion de la modifification
  const handleModif = (id) => {
    history.replace(`/sbu/nomenclatures/${id}`);
    toast.info("Modification d'une nomenclaclature");
  };

  //gestion du chargement
  const handleChangePage = (page) => setCurrentPage(page);

  //gestion de la recherche
  const handleSearch = ({currentTarget}) => {
    setSearch(currentTarget.value);
    setCurrentPage(1);
  };

  const itemsPerPage = 5;

  //filtrage des nomenclatures en fonctions de la recherche
  const filteredNomens = nomens.filter(
    (n) =>
      n.anneeApplication.toLowerCase().includes(search.toLowerCase()) ||
      n.decretAdoption.toLowerCase().includes(search.toLowerCase()) ||
      n.decretApplication.toLowerCase().includes(search.toLowerCase())
  );

  //pagination des données
  const paginatedNomens = Pagination.getData(
    filteredNomens,
    currentPage,
    itemsPerPage
  );

  return (
    <section id="exp">
      <div className="product-detail-page">
        <h3 className="card-header">
          <div className="row">
            <div className="text-left col-sm-6">NOMENCLATURE</div>
            <div className="text-right col-sm-6">
              <button className="btn-sm btn-secondary">{nomens.nabro}</button>
            </div>
          </div>
        </h3>
        <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
          <li className="nav-item m-b-0">
            <a className="nav-link f-18 p-b-0" href="#/sbu/nomenclatures/new">
              Enregistrement
            </a>
            <div className="slide" />
          </li>
          <li className="nav-item">
            <a
              className="nav-link active f-18 p-b-0"
              href="#/sbu/nomenclatures"
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
                          Liste de nomenclatures
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
                            <th>Année application</th>
                            <th>Décret d'adoption</th>
                            <th>Date d'adoption</th>
                            <th>Décret d'application</th>
                            <th>Date d'application</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {paginatedNomens.map((nomen) => (
                            <tr key={nomen.id}>
                              <td>{nomen.id}</td>
                              <td>{nomen.anneeApplication}</td>
                              <td>{nomen.decretAdoption} </td>
                              <td>{nomen.dateAdoption}</td>
                              <td>{nomen.decretApplication}</td>
                              <td>{nomen.dateApplication}</td>

                              <td>
                                <button
                                  onClick={() => handleDelete(nomen.id)}
                                  className="m-r-20 btn btn-sm btn-danger "
                                  disabled={
                                    nomen.assiociationCompteNature.length > 0
                                  }
                                >
                                  <i className="fa fa-trash"></i>
                                </button>
                                <button
                                  disabled={
                                    nomen.assiociationCompteNature.length > 0
                                  }
                                  onClick={() => handleModif(nomen.id)}
                                  className="m-r-20 btn btn-sm btn-primary"
                                >
                                  <i className="fa fa-edit"></i>
                                </button>

                                <button
                                  onClick={() => handleView(nomen.id)}
                                  className="btn btn-sm btn-secondary "
                                  disabled={
                                    nomen.assiociationCompteNature.length > 0
                                  }
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
                  {itemsPerPage < filteredNomens.length && (
                    <Pagination
                      currentPage={currentPage}
                      itemsPerPage={itemsPerPage}
                      length={filteredNomens.length}
                      onPageChanged={handleChangePage}
                    />
                  )}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};
export default ConsultNomen;
