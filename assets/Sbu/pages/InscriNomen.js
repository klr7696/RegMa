import axios from "axios";
import React, { useState } from "react";


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

export default InscriNomen;
