import axios from 'axios';
import React, { useEffect, useState } from 'react';
import OuvriExerc from '../../../Sbu/pages/Exercice/OuvriExerc';

const ConsultPlan = () => {

    
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
           Plan de passation
            </div>
                <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link f-18 p-b-0"
                href="#/scp/plan/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link active f-18 p-b-0"
                 href="#/scp/plan"
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
            <h5 className="card-header-text">PLAN PRIMITIF DU PLAN DE PASSATION DES MARCHES PUBLICS DE LA COMMUNE DE BOBO-DIOULASSO GESTION 2021</h5>
            <div className="card-block">
           
     <div className="table-responsive dt-responsive">
       <table
         id="lang-file"
         className="table table-striped table-bordered nowrap"
       >
         <thead>
           <tr>
            <th>id</th>
             <th>Niveau de priorité</th>
             <th>Source de financement</th>
             <th>Ligne budgétaire</th>
             <th>Montant de l'inscription budgétaire 2020</th>
             <th>Crédits disponibles en 2020</th>
             <th>Nature des prestations</th>
             <th>Mode de passation</th>
             <th>Période de pub des appel à la concurrence</th>
             <th>Période de remise des offres ou propositions</th>
             <th>Temps évaluation</th>
             <th>Date probable de démarrage</th>
             <th>Délais prévisionnel d'exécution</th>
             <th>Observations</th>
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
                        <td>{plan.id}</td>
                        <td>{plan.presidentCommission}</td>
                        <td>{plan.ordonnateurPlan}</td>
                        <td>{plan.AdresseDepouillement} </td>
                        <td>{plan.descriptionPlan}</td>
                        <td>{plan.id}</td>
                        <td>{plan.presidentCommission}</td>
                        <td>{plan.ordonnateurPlan}</td>
              </tr>)}
            </tbody>
       </table>
           <h6 className="card-footer-text">  
             <div className="row">
            <div className="text-left col-sm-8">
             Le Président de la CCAM
             {plans.presidentCommission}
            </div>
             <div className="text-right col-sm-4">
               Approuvé par le Maire
                 {plans.ordonnateurPlan}
            </div>
             </div>
             </h6>
     </div>
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

export default ConsultPlan;