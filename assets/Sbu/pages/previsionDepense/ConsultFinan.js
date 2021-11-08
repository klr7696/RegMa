import { setCurrencyCode } from '@syncfusion/ej2-base';
import axios from 'axios';
import React, { useEffect, useState } from 'react';

const ConsultFinan = () => {
  const [finans, setFinans] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/ressources")
      .then(response => response.data["hydra:member"])
      .then(data => setFinans(data));
  }, []);

    return (
        <section id="exp">
        <div className="product-detail-page">
        <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-6">
            RESSOURCE FINANCIERE 
            </div>
            <div className="text-right col-sm-6">
                <button className="btn-sm btn-secondary">
                  Gestion 2021
                </button>
              </div>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link f-18 p-b-0"
                href="#/sbu/financement/new"
              >
                Inscription
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/financements"
              >
                Actualisation
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link active f-18 p-b-0"
                 href="#/sbu/financement"
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
     
     <h5 className="card-header-text">Listes des financements</h5>
     <div className="table-responsive dt-responsive">
       <table
         id="lang-file"
         className="table table-striped table-bordered nowrap"
       >
         <thead>
           <tr>
              <th>id</th>
             <th>Bailleur</th>
             <th>Objet</th>
             <th>Mode</th>
             <th>Exercice</th>
             <th>Montant</th>
             <th>Description</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
            {finans.map(finan =>
                        <tr key={finan.id} value={finan.id}>
                        <td>{finan.id}</td>
                        <td>{finan.bailleurFonds[0].sigleBailleur}</td>
                        <td>{finan.objetFinancement}</td>
                        <td>{finan.modeFinancement} </td>
                        <td>{finan.excerciceRegistre}</td>
                        <td>{finan.montantFinancement.toLocaleString('fr-FR', {style: 'currency', currency: 'XAF'})}</td>
                        <td>{finan.descriptionFinancement}</td>
                        <td>{}</td>
              </tr>)}
            </tbody>
       </table>
     </div>
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

export default ConsultFinan;