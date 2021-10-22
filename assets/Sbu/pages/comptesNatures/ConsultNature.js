import axios from "axios";
import React, {useEffect, useState } from "react";

const ConsultNature = () => {
    const [chaps, setChaps] = useState([]);

    useEffect(() => {
      axios
        .get("http://localhost:8000/api/natures")
        .then(response => response.data["hydra:member"])
        .then(data => setChaps(data));
    }, []);
  
    return (
        <section id="exp">
        <div className="product-detail-page">
          <h3 className="card-header">
            <div className="row">
            <div className="text-left col-sm-6">
            Classification par nature 
            </div>
            <div className="text-right col-sm-6">
                <button className="btn-sm btn-secondary">
                  Gestion 2021
                </button>
              </div>
            </div>
          </h3>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/chap/new"
              >
                Chapitre
              </a>
              <div className="slide" />
            </li>
    
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/arti/new"
              >
                Article
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/para/new"
              >
                Paragraphe
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link active f-18 p-b-0"
                href="#/sbu/compte-nature"
              >
                Consultation
              </a>
              <div className="slide" />
            </li>
    
          </ul>
          <div className="card">
            <div className="card-block">
             
              <div className="page-body">
            <div className="card-block">
            <div className="row form-group">
        <div className="text-left col-sm-9">
        <h5 className="card-header-text">Listes des comptes</h5>
        </div>
        <div className="text-right col-sm-3">
              <input className="form-control" placeholder="Rechercher..."/>
        </div>
        </div>
        <div className="table-responsive dt-responsive">
          <table
            id="lang-file"
            className="table table-striped table-bordered nowrap"
          >
        <thead>
                    <tr>
                      <th>Num</th>
                      <th>Libéllé</th>
                      <th>Section</th>
                      <th>Hierar</th>
                      <th>Nomen</th>
                    </tr>
                    </thead>
                    <tbody>
                    {chaps.map(chap =>
                          <tr key={chap.id}>
                            <td>{chap.numeroCompteNature}</td>
                          <td>{chap.libelleCompteNature}</td>
                          <td>{chap.sectionCompteNature}</td>
                          <td>{chap.hierachieCompteNature}</td>
                          <td>{chap.nomenclature}</td>
                         
                </tr>)}
                     
                    </tbody>
                
         </table>
           </div>
           </div></div>
               </div>
               </div>
        </div>
  </section>
     );
}
 
export default ConsultNature;