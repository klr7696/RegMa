import axios from "axios";
import React, { useState, useEffect } from "react";
import InscriNomen from "./InscriNomen";


const ConsultNomen = (props) => {

  const [nomens, setNomens] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/nomenclatures")
      .then(response => response.data["hydra:member"])
      .then(data => setNomens(data));
  }, []);

  return (
    <div className="page-body">
      <div className="card-block">
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
                        <td>{nomen.anneeApplication}</td>
                        <td>{nomen.decretAdoption} </td>
                        <td>{nomen.dateAdoption}</td>
                        <td>{nomen.decretApplication}</td>
                        <td>{nomen.dateApplication}</td>
                        <td>{nomen.descriptionNomenclature}</td>
              </tr>)}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

  const Nomenclature = () =>{
    return (
      <section id="exp">
        <div className="product-detail-page">
          <h4 className="card-header">
            <div className="row">
              <div className="text-left col-sm-6">NOMENCLATURE</div>

              <div className="text-right col-sm-6">
                <button className="btn-sm btn-secondary">Gestion 2021</button>
              </div>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
                className="nav-link active f-18 p-b-0"
                data-toggle="tab"
                href="#creer"
                role="tab"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                data-toggle="tab"
                href="#consulter"
                role="tab"
              >
                Consultation
              </a>
              <div className="slide" />
            </li>
          </ul>
          <div className="card">
            <div className="card-block">
              <div className="tab-content bg-white">
                <div className="tab-pane active" id="creer" role="tabpanel">
                  <InscriNomen />
                </div>
                <div className="tab-pane" id="consulter" role="tabpanel">
                  <ConsultNomen />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    );
  }
export default Nomenclature;
