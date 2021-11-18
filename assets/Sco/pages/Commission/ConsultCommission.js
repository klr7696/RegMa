import axios from 'axios';
import React, { useEffect, useState } from 'react';
import OuvriExerc from '../../../Sbu/pages/Exercice/OuvriExerc';

const ConsultCommission = () => {

    
  const [plans, setPlans] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/plans")
      .then(response => response.data["hydra:member"])
      .then(data => setPlans(data));
  }, []);


    return (
    <section id="exp">
      <div className="product-detail-page">
        <h4 className="card-header">
          <div className="row">
            <div className="text-left col-sm-8">
            Commission
            </div>
                <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link f-18 p-b-0"
                href="#/sco/commission/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link active f-18 p-b-0"
                 href="#/sco/commission"
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
            <div className="card-block">
            <h5 className="card-header-text">Listes des commissions </h5>
            </div>
     <div className="table-responsive dt-responsive">
       <table
         id="lang-file"
         className="table table-striped table-bordered nowrap"
       >
         <thead>
           <tr>
              <th>id</th>
             <th>Président Commission</th>
             <th>Ordonnateur</th>
             <th>Adresse de depouillement</th>
             <th>Description</th>
           </tr>
         </thead>
         <tbody>
            {plans.map(plan =>
                        <tr key={plan.id} value={plan.id}>
                        <td>{plan.id}</td>
                        <td>{plan.presidentCommission}</td>
                        <td>{plan.ordonnateurPlan}</td>
                        <td>{plan.AdresseDepouillement} </td>
                        <td>{plan.descriptionPlan}</td>
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

export default ConsultCommission;