import axios from 'axios';
import React, { useEffect, useState } from 'react';
import OuvriExerc from '../../../Sbu/pages/Exercice/OuvriExerc';

const InscriOperation = (props) => {
 
  const { id = "new" } = props.match.params;

  const [plans, setPlans] = useState({
    presidentCommission: "",
    ordonnateurPlan: "",
    AdresseDepouillement: "",
    descriptionPlan: ""
  });

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setPlans({...plans, [name]: value });
  };
 
  const handleSubmit = async event => {
    event.preventDefault();
    
     try {
      const response = await axios
      .post("http://localhost:8000/api/plans", plans );
      console.log(response.data);
  } catch(error) {
   console.log(error.response)
   setErrors("Informations incorrectes")
  }
}; 

    return (
    <section id="exp">
      <div className="product-detail-page">
        <h4 className="card-header">
          <div className="row">
            <div className="text-left col-sm-8">
           Opération de dépense
            </div>
            <div className="text-right col-sm-4">
                <OuvriExerc/>
              </div>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link active f-18 p-b-0"
                href="#/sde/operation/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link f-18 p-b-0"
                 href="#/sde/operation"
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
                    <label className="col-form-label">Président Commission</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Ordonnateur</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                    />
                  </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Adresse de depouillement</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Description</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
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

export default InscriOperation;