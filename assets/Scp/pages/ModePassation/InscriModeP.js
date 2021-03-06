import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { toast } from 'react-toastify';
import OuvriExerc from '../../../Sbu/pages/Exercice/OuvriExerc';

const InscriModeP = (props) => {
 
  const { id = "new" } = props.match.params;

  const [modeP, setModeP] = useState({
  designationMode: "",
  abbreviationMode: "",
  categorieMode: "",
  naturePrestation: "",
  seuilsMinimum: "",
  seuilsMaximum: "",
  descriptionMode: ""
  });

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setModeP({...modeP, [name]: value });
  };
 
  const handleSubmit = async event => {
    event.preventDefault();
    
     try {
      const response = await axios
      .post("http://localhost:8000/api/modes", modeP );
      console.log(response.data);
      toast.success("Mode de passation créé")
  } catch(error) {
   console.log(error.response)
   setError("Informations incorrectes")
  }
}; 

    return (
    <section id="exp">
      <div className="product-detail-page">
        <h4 className="card-header">
          <div className="row">
            <div className="text-left col-sm-8">
            Mode de passation
            </div>
                <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link active f-18 p-b-0"
                href="#/scp/mode-passation/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link f-18 p-b-0"
                 href="#/scp/mode-passation"
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
                    <label className="col-form-label">Désignation</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="designationMode"
                      value={modeP.designationMode}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Abbreviation</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="abbreviationMode"
                      value={modeP.abbreviationMode}
                    />
                  </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Catégorie</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="categorieMode"
                      value={modeP.categorieMode}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Nature prestation</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="naturePrestation"
                      value={modeP.naturePrestation}
                    />
                  </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Seuils minimum</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="number"
                      className="form-control"
                      onChange={handleChange}
                      name="seuilsMinimum"
                      value={modeP.seuilsMinimum}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Seuils maximum</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="number"
                      className="form-control"
                      onChange={handleChange}
                      name="seuilsMaximum"
                      value={modeP.seuilsMaximum}
                    />
                  </div>
                </div>
                <div className="row form-group">
                  <div className="col-sm-2">
                    <label className="col-form-label">Description</label>
                  </div>
                  <div className="col-sm-10">
                    <textarea
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                      name="descriptionMode"
                      value={modeP.descriptionMode}
                    />
                  </div>
                </div>
                <div className="text-right col-sm-12">
                  <button type="submit" className="btn btn-primary">Créer</button>
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

export default InscriModeP;