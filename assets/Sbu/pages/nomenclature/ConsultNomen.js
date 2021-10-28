import axios from "axios";
import React, { useState, useEffect } from "react";
import { toast } from "react-toastify";


const ConsultNomen = (props) => {


  const [nomens, setNomens] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/nomenclatures")
      .then(response => response.data["hydra:member"])
      .then(data => setNomens(data));
      toast.success("liste chargée avec succès");
  }, []);

  const convert = date => {
    return date.toLocaleString('ko KR', {timeZone: 'UTC'})
  }
  return (
  <section id="exp">
  <div className="product-detail-page">
    <h3 className="card-header">
      <div className="row">
      <div className="text-left col-sm-6">
      NOMENCLATURE
      </div>
      <div className="text-right col-sm-6">
          <button className="btn-sm btn-secondary">
            {nomens.nabro}
          </button>
        </div>
      </div>
    </h3>
    <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
      <li className="nav-item m-b-0">
        <a
          className="nav-link f-18 p-b-0"
          href="#/sbu/nomenclature/new"
        >
          Enregistrement
        </a>
        <div className="slide" />
      </li>
      <li className="nav-item">
        <a
          className="nav-link active f-18 p-b-0"
          href="#/sbu/nomenclature"
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
        <h5 className="card-header-text">Liste de nomenclatures</h5>
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
                <th>Année application</th>
                <th>Décret d'adoption</th>
                <th>Date d'adoption</th>
                <th>Décret d'application</th>
                <th>Date d'application</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
            {nomens.map(nomen =>
                        <tr key={nomen.id}>
                        <td>{nomen.id}</td>
                        <td>{nomen.anneeApplication}</td>
                        <td>{nomen.decretAdoption} </td>
                        <td>{nomen.dateAdoption}</td>
                        <td>{nomen.decretApplication}</td>
                        <td>{nomen.dateApplication}</td>
                        <td>{nomen.assiociationCompteNature}</td>
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
export default ConsultNomen;
