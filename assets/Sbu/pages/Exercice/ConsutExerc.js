import axios from "axios";
import React, {useState, useEffect} from "react";
import formatDate from "../../../zforms/FormatDate";
import OuvriExerc from "./OuvriExerc";

const ConsultExerc = () =>{

  const [exercs, setExercs] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/registres")
      .then(response => response.data["hydra:member"])
      .then(data => setExercs(data));
  }, []);

   const magiscule = string => {
     return string.toUpperCase()
   }

  return (
  <section id="exp">
  <div className="product-detail-page">
  <h3 className="card-header">
            <div className="row">
            <div className="text-left col-sm-8">
            Exercice
            </div>
            <OuvriExerc/>
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
            className="nav-link f-18 p-b-0"
            href="#/sbu/clos-exercice"
          >
            Clôture
          </a>
          <div className="slide" />
        </li>

        <li className="nav-item m-b-0">
          <a
            className="nav-link active f-18 p-b-0"
            href="#/sbu/exercice"
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
        <h5 className="card-header-text">Liste des Exercices</h5>
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
            <th>Année</th>
            <th>Ordonnateur</th>
            <th>Date de vote</th>
            <th>Date d'adoption</th>
            <th>Nomenclature</th>
            <th>Action</th>
              </tr>
            </thead>
            <tbody>
            {exercs.map(exerc =>
                        <tr key={exerc.id} value={exerc.id}>
                        <td>{exerc.id}</td>
                        <td>{exerc.anneeExercice}</td>
                        <td></td>
                        <td>{formatDate(exerc.dateVote)}</td>
                        <td>{formatDate(exerc.dateAdoption)}</td>
                        <td>Nomenclature {exerc.nomenclature.anneeApplication}</td>
                        <td></td>
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

export default ConsultExerc ;
