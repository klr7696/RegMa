import axios from "axios";
import React, {useState, useEffect } from "react";

const ConsultBaill = () => {

  const [bailleurs, setBailleurs] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/bailleurs/actifressource")
      .then(response => response.data["hydra:member"])
      .then(data => setBailleurs(data));
  }, []);

  const handleDelete = id => {
    console.log(id);

    const originalBailleurs = [...bailleurs]
    setBailleurs(bailleurs.filter(bailleur => bailleur.id !== id))

   axios.delete("http://localhost:8000/api/bailleurs/" + id)
   .then(response => console.log("OK") )
  .catch(error => {
    setBailleurs(originalBailleurs);
    console.log(error.response)
  });
  };

const handleModif = id => {

}

  return (
    <section id="exp">
    <div className="product-detail-page">
      <h3 className="card-header">
        <div className="row">
        <div className="text-left col-sm-6">
        BAILLEUR DE FONDS 
        </div>
        <div className="text-right col-sm-6">
            <button className="btn-sm btn-secondary">
              Gestion 2021
            </button>
          </div>
        </div>
      </h3>
      <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
        <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/bailleurs/new"
          >
            Enregistrement
          </a>
          <div className="slide" />
        </li>
        <li className="nav-item">
          <a
            className="nav-link active f-18 p-b-0"
            href="#/sbu/bailleurs"
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
        <h5 className="card-header-text">Listes des Bailleurs de fonds</h5>
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
                <td>id</td>
                <th>Désignation</th>
                <th>Sigle</th>
                <th>Catégorie</th>
                <th>Code</th>
                <th>Source Financement</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            {bailleurs.map(bailleur =>
               <tr key={bailleur.id}>
                        <td>{bailleur.id}</td>
                        <td>{bailleur.designationBailleur}</td>
                        <td>{bailleur.sigleBailleur}</td>
                        <td>{bailleur.categorieBailleur}</td>
                        <td>{bailleur.id}</td>
                        <td>{bailleur.sourceFinancement}</td>
                        <td>{bailleur.id}</td>
                        <td>
                          <button 
                          onClick={() => handleDelete(bailleur.id)}
                          className="btn btn-sm btn-danger "
                          disabled
                           >
                            Supprimer
                          </button>
                           <button 
                          onClick={() => handleModif(bailleur.id)}
                          className="btn btn-sm btn-primary" >
                            Modifier
                          </button>
                        </td>
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
export default ConsultBaill;
