import axios from 'axios';
import React, { useEffect, useState } from 'react';

const ConsultCredit = () => {

    const [creds, setCreds] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/ouverts")
      .then(response => response.data["hydra:member"])
      .then(data => setCreds(data));
  }, []);

    return (
        <section id="exp">
        <div className="product-detail-page">
          <h3 className="card-header">
            <div className="row">
            <div className="text-left col-sm-6">
            Crédit ouvert
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
                href="#/sbu/cred-ouvert/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
    
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/cred-ouver/new"
              >
                Actualisation
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link active f-18 p-b-0"
                href="#/sbu/cred-ouvert"
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
        <h5 className="card-header-text">Liste de credclatures</h5>
        </div>
        <div className="text-right col-sm-3">
              <input className="form-control" placeholder="Rechercher..."/>
        </div>
        </div>
        <div className="table-responsive">
          <table
           className="table table-bordered"
          >
            <thead>
              <tr>
               <th>id</th>
                <th>Montant (FCFA)</th>
                <th>Ressource Financière</th>
                <th>Compte Nature</th>
                <th>Description</th>
                <th>Status Valide</th>
              </tr>
            </thead>
            <tbody>
            {creds.map(cred =>
                        <tr key={cred.id}>
                        <td>{cred.id}</td>
                        <td>{cred.anneeApplication}</td>
                        <td>{cred.decretAdoption} </td>
                        <td>{cred.dateAdoption}</td>
                        <td>{cred.decretApplication}</td>
                        <td>{cred.dateApplication}</td>
                        <td>{cred.assiociationCompteNature}</td>
              </tr>)}
            </tbody>
          </table>
          </div>
      </div>
    </div>
            </div>
            <div className="tab-pane" id="enregistrement" role="tabpanel">
            </div>
          </div>
        </div>
    </div>
      </div>
    </section>
    );
};

export default ConsultCredit;