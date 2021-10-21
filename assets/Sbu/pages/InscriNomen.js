import axios from "axios";
import React, { useState, useEffect } from "react";


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
  );
};
export default ConsultNomen;
