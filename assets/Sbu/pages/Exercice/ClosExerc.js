import axios from "axios";
import React, {useState, useEffect} from "react";

const ClosExerc = () =>{

  const [exercs, setExercs] = useState({
    AnneeExercice: "2019",
    ordonateurExercice: "Borahima",
    dateVote: "",
    dateAdoption: "2019-10-10",
    description: "",
    nomenclature: "/api/nomenclatures/16"
  });

  const [error, setError] = useState("");

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setExercs({...exercs, [name]: value });
  };

  const handleSubmit = async event => {
    event.preventDefault();

    try {
     await axios
      .post("http://localhost:8000/api/registres", exercs)
      console.log(response.data);
    } catch(error) {
      console.log(error.response);
     setError("Informations incorrectes")
    }
   
  };

  return (
    <section id="exp">
    <div className="product-detail-page">
      <h3 className="card-header">
        <div className="row">
        <div className="text-left col-sm-6">
        EXERCICE
        </div>
        <div className="text-right col-sm-6">
            <button className="btn-sm btn-secondary">
              Gestion 2021
            </button>
          </div>
        </div>
      </h3>
      <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
        <li className="nav-item">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/exercice/new"
          >
            Ouverture
          </a>
          <div className="slide" />
        </li>

        <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/modif-exercice"
          >
            Modification
          </a>
          <div className="slide" />
        </li>
         <li className="nav-item m-b-0">
          <a
            className="nav-link active f-18 p-b-0"
            href="#/sbu/clos-exercice"
          >
            Clôture
          </a>
          <div className="slide" />
        </li>

        <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/exercice"
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
          <form onSubmit={handleSubmit}>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Année *</label>
                </div>
                <div className="col-sm-3">
                  <input
                    name="AnneeExercice"
                    type="number"
                    className={"form-control required" + (error && " is-invalid")}
                    data-v-max={2100}
                    data-v-min={0}
                    value={exercs.AnneeExercice}
                    onChange={handleChange}
                  />
                  {error && <p className="invalid-feedback">{error}</p>}
                </div>
                <div className="col-sm-2">
                    <label className="col-form-label">Nomenclature</label>
                  </div>
                    <div className="col-sm-2">
                    <select 
                    disabled="disabled"
                    onChange={handleChange} 
                    name="nomenclature"
                    id="nomenclature"
                    value={exercs.nomenclature}
                    className={"form-control" + (error && " is-invalid")}
                   >
                     {nomenclatures.map(nomenclature => <option key={nomenclature.id} value={nomenclature.id}>
                       {nomenclature.anneeApplication}
                     </option>)}
                      </select>
                    </div>
              </div>
             
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Ordonnateur *</label>
                </div>
                <div className="col-sm-10">
                  <input
                    id="ordonateurExercice"
                    name="ordonateurExercice"
                    type="text"
                    className={"form-control required" + (error && " is-invalid")}
                    data-a-sign="MR. "
                    value={exercs.ordonateurExercice}
                    onChange={handleChange}
                  />
                  {error && <p className="invalid-feedback">{error}</p>}
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Date de vote *</label>
                </div>
                <div className="col-sm-4">
                  <input
                    id="dateVote"
                    name="dateVote"
                    type="date"
                    className={"form-control required" + (error && " is-invalid")}
                    data-a-sign="MR. "
                    value={exercs.dateVote}
                    onChange={handleChange}
                  />
                  {error && <p className="invalid-feedback">{error}</p>}
                </div>
             
                <div className="col-sm-2">
                  <label className="col-form-label">Date d'adoption *</label>
                </div>
                <div className="col-sm-4">
                  <input
                    id="dateAdoption"
                    name="dateAdoption"
                    type="date"
                    className={"form-control required" + (error && " is-invalid")}
                    data-a-sign="MR. "
                    value={exercs.dateAdoption}
                    onChange={handleChange}
                  />
                  {error && <p className="invalid-feedback">{error}</p>}
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea 
                  id="description"
                  name="description"
                  type="text" 
                  className={"form-control required" + (error && " is-invalid")} 
                   value={exercs.description}
                    onChange={handleChange}
                  />
                  {error && <p className="invalid-feedback">{error}</p>}
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button 
                disabled={exercs.estEnCours=true}
                type="submit" 
                className="btn btn-primary">
                  Ouvrir
                </button>
              </div>
            </form>
            </div>
        </div>
      </div>
    </div>
        </div>
      </div>
    </div>
  </section>
  );
};

export default ClosExerc ;
