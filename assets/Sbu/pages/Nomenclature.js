import axios from "axios";
import React, { useState } from "react";
import ConsultNomen from "./InscriNomen";

const InscriNomen = (props) =>{

  console.log(props);

  const [nomens, setNomens] = useState({
    anneeApplication: "",
    decretAdoption: "",
    dateAdoption: "",
    decretApplication: "",
    dateApplication: "",
    descriptionNomenclature: ""
  });

  const [error, setErrors] = useState("");

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setNomens({...nomens, [name]: value });
  };

  const handleSubmit = async event => {
    event.preventDefault();

    try {
      const response = await axios.post("http://localhost:8000/api/nomenclatures", nomens)
      console.log(response.data);
    } catch(error) {
      console.log(error.response);
      setErrors("Erreur de Saisie")
    }
   
  };

  return (
    <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          <div className="card-block">
            <form onSubmit={handleSubmit}>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Année de mise en application *
                  </label>
                </div>
                <div className="col-sm-3">
                  <input
                    name="anneeApplication"
                    type="number"
                    className={"form-control" + (error && " is-invalid")}
                    placeholder="2021"
                    value={nomens.anneeApplication}
                    onChange={handleChange}
                    required
                  />
                   {error && <p className="invalid-feedback">{error}</p> }
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Décret d'adoption *</label>
                </div>
                <div className="row col-sm-10">
                  <div className="col-sm-9">
                    <input
                      name="decretAdoption"
                      type="text"
                      className="form-control"
                      value={nomens.decretAdoption}
                      onChange={handleChange}
                      required
                    />
                  </div>
                  <div className="col-sm-3">
                    <input 
                    name="dateAdoption"
                    type="date" 
                    className="form-control" 
                    value={nomens.dateAdoption}
                    onChange={handleChange}
                    required
                    />
                  </div>
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Décret d'application *
                  </label>
                </div>
                <div className="row col-sm-10">
                  <div className="col-sm-9">
                    <input 
                    name="decretApplication"
                    type="text" 
                    className="form-control" 
                    value={nomens.decretApplication}
                    onChange={handleChange}
                    required
                    />
                  </div>
                  <div className="col-sm-3">
                    <input 
                    name="dateApplication"
                    type="date"
                    className="form-control"
                    value={nomens.dateApplication}
                    onChange={handleChange}
                    required
                     />
                  </div>
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea
                  name="descriptionNomenclature" 
                  type="text" 
                  className="form-control" 
                  value={nomens.descriptionNomenclature}
                  onChange={handleChange}
                  />
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button type="submit" className="btn btn-primary">
                  Créer
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};


  const Nomenclature = () =>{
    return (
      <section id="exp">
        <div className="product-detail-page">
          <h4 className="card-header">
            <div className="row">
              <div className="text-left col-sm-6">NOMENCLATURE</div>

              <div className="text-right col-sm-6">
                <button className="btn-sm btn-secondary">Gestion 2021</button>
              </div>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
                className="nav-link active f-18 p-b-0"
                href="#/sbu/nomenclature/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/nomenclature"
              >
                Consultation
              </a>
              <div className="slide" />
            </li>
          </ul>
          <div className="card">
            <div className="card-block">
              <div className="tab-content bg-white">
                <div className="tab-pane active" id="creer" role="tabpanel">
                  <InscriNomen />
                </div>
                <div className="tab-pane" id="consulter" role="tabpanel">
                  <ConsultNomen />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    );
  }
export default Nomenclature;
