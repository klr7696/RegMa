import axios from 'axios';
import React, { useEffect, useState } from 'react';
import OuvriExerc from '../../../Sbu/pages/Exercice/OuvriExerc';

const InscriContrat = (props) => {
 
  const { id = "new" } = props.match.params;

  const [plans, setPlans] = useState({
    typeContrat: "",
    montantMinimum: 0,
    montantMinimumLettre: "",
    montantMaximum: 0,
    montantMaximumLettre: "",
    numeroContrat: 0,
    referenceContrat: "",
    dateApprobation: "",
    dateNotification: "",
    estApprouver: "Oui",
    descriptionContrat: "",
    marche: "",
    associationBon: "",
    associationEngagement: "",
    offreMarche: "",
    associationDecision: "",
    associationException: "",
    soumissionnaire: ""
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
           Contrat
            </div>
                <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link active f-18 p-b-0"
                href="#/scp/contrat/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link f-18 p-b-0"
                 href="#/scp/contrat"
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
                    <label className="col-form-label">Type contrat</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Approuvé</label>
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
                    <label className="col-form-label">Montant minimum</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Montant minimum lettre</label>
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
                    <label className="col-form-label">Montant maximum</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Montant maximum lettre</label>
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
                    <label className="col-form-label">Numero contrat</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Reference contrat</label>
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
                    <label className="col-form-label">Date approbation</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="date"
                      className="form-control"
                      onChange={handleChange}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Date notification</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="date"
                      className="form-control"
                      onChange={handleChange}
                    />
                  </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                    <label className="col-form-label">Marché</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Bon de commande</label>
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
                    <label className="col-form-label">Engagement</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Offre de marché</label>
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
                    <label className="col-form-label">Decision</label>
                  </div>
                  <div className="col-sm-4">
                    <input
                      type="text"
                      className="form-control"
                      onChange={handleChange}
                    />
                  </div>
                  <div className="col-sm-2">
                    <label className="col-form-label">Exception</label>
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
                    <label className="col-form-label">Soumissionnaire</label>
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
                    <textarea
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

export default InscriContrat;