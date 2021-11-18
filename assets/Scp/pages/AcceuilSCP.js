import axios from 'axios';
import React, { useState,useEffect } from 'react';

 
  const AcceuilSCP = () => {

    const [natures, setNatures] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/natures")
      .then(response => response.data["hydra:member"])
      .then(data => setNatures(data));
  }, []);


    return (

      <div className="page-body">
        <div className="card">
           <div className="card-block">
        <h5 className="card-header-text center">ETAT DE DEVELOPPEMENT DES INSCRIPTIONS BUDGETAIRES</h5>
        <div className="card-block">
        <h5 className="card-header-text">DEPENSES DE FONCTIONNEMENT</h5>
          <div className="table-responsive dt-responsive">
            <table
              id="lang-file"
              className="table table-striped table-bordered nowrap"
            >
              <thead>
                <tr>
                  <th>chap</th>
                  <th>art</th>
                  <th>Par</th>
                  <th>Libellés</th>
                  <th>Budget 2021</th>
                  <th>Budget 2022</th>
                  <th>Développement et explication</th>
                </tr>
              </thead>
              <tbody>
              {natures.map(nature => <tr>
                  <td>{nature.numeroCompteNature}</td>
                  <td>{nature.numeroCompteNature}</td>
                  <td></td>
                  
                </tr>
                )}
              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
    </div>
    );
  };
 
export default AcceuilSCP;