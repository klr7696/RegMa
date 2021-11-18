import axios from 'axios';
import React, { useEffect, useState } from 'react';
import OuvriExerc from '../../../Sbu/pages/Exercice/OuvriExerc';

const ConsultModeP = () => {

    
  const [modes, setModes] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/modes")
      .then(response => response.data["hydra:member"])
      .then(data => setModes(data));
  }, []);


    return (
    <section id="exp">
      <div className="product-detail-page">
        <h4 className="card-header">
          <div className="row">
            <div className="text-left col-sm-8">
          Lot de marché
            </div>
            <div className="text-right col-sm-4">
                <OuvriExerc/>
              </div>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link f-18 p-b-0"
                href="#/scp/mode-passation/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link active f-18 p-b-0"
                 href="#/scp/mode-passation"
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
            <h5 className="card-header-text">Listes des modes de passation</h5>
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
       
            {modes.map(mode =>
                        <tr key={mode.id} value={mode.id}>
                        <td>{mode.id}</td>
                        <td>{mode.designationMode}</td>
                        <td>{mode.abbreviationMode}</td>
                        <td>{mode.categorieMode} </td>
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

export default ConsultModeP;