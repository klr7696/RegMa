import axios from "axios";
import React, {useEffect, useState } from "react";

const CredOuvert = () => {

   {/* const [cred, setCreds] = useState({
        numeroCompteNature: 61,
        libelleCompteNature : "",
        sectionCompteNature: "Fonctionnement",
        hierachieCompteNature: "Chapitre",
        descriptionCompteNature: "",
        nomenclature:""
      });
    
      const [error, setErrors] = useState("");
      const [nomenclatures, setNomens] = useState([]);
    
      const fetchNomen = async () => {
        try{
      const data = await axios
      .get("http://localhost:8000/api/nomenclatures?estActif=true")
      .then(response => response.data["hydra:member"]);
        setNomens(data);
        if (!chaps.nomenclature) setChaps({...chaps, nomenclature:data[0].id} )
        } catch (error) {
        console.log(error.response);
        }
      };
    
      useEffect(() =>{
          fetchNomen();
      }, []);
    
      const handleChange = ({ currentTarget }) => {
        const { name, value } = currentTarget;
        setChaps({...chaps, [name]: value });
      };
    
      const handleSubmit = async event => {
        event.preventDefault();
    
        try {
          const response = await axios
          .post("http://localhost:8000/api/natures/chapitres", {...chaps,
        nomenclature:`/api/nomenclatures/${chaps.nomenclature}`});
          console.log(response.data);
        } catch(error) {
          console.log(error.response);
          setErrors("Erreur de Saisie")
        }
       
      };*/}
    
    return ( 
      <section id="exp">
      <div className="product-detail-page">
        <h3 className="card-header">
          <div className="row">
          <div className="text-left col-sm-6">
          Crédit ouvert
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
              className="nav-link active f-18 p-b-0"
              href="#/sbu/cred-ouvert/new"
            >
              Création
            </a>
            <div className="slide" />
          </li>
  
          <li className="nav-item m-b-0">
            <a
              className="nav-link f-18 p-b-0"
              href="#/sbu/arti/new"
            >
              Actualisation
            </a>
            <div className="slide" />
          </li>
          <li className="nav-item m-b-0">
            <a
              className="nav-link f-18 p-b-0"
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
        <div className="row">
          <div className="col-sm-12">
           
           
              <form >
             
              <div className="card">
              <div className="card-block">
                <div className="row form-group">
                  <div className="col-sm-2">
                <label className="col-form-label">Bailleur *</label>
                  </div>
                  <div className="col-sm-2">
                  <select className="form-control">
                  <option value="1">Etat</option>
                  <option value="2">Commune</option>
                </select>
                  </div>
                 <div className="col-sm-1">
                 <label className="col-form-label">Objet *</label>
                  </div>
                    <div className="col-sm-3">
                    <select className="form-control"
                    name="sectionCompteNature"
                    id="sectionCompteNature"
                   >
                      <option value="Fonctionnement">Fonctionnement</option>
                      <option value="Investissement">Investissement</option>
                    </select>
                    </div>
                    <div className="col-sm-1">
                <label className="col-form-label">Exercice</label>
              </div>
              <div className="col-sm-2">
                <select className="form-control" disabled="disabled">
                  <option selected="">...</option>
                  <option value="1">Fonctionnement</option>
                  <option value="2">Investissement</option>
                </select>
              </div>
                </div>
                <div className="row form-group">
              <div className="col-sm-2">
                <label className="col-form-label">Montant (FCFA)</label>
              </div>
              <div className="col-sm-6">
                <input type="number" className="form-control" readonly=""/>
              </div>
              </div>
              </div>
              </div>
              <div className="card">
              <div className="card-block">
              <div className="row form-group">
              <div className="col-sm-2">
                <label className="col-form-label">Numéro du comptes </label>
              </div>
              <div className="col-sm-2">
                <input type="text" className="form-control"/>
              </div>
              <div className="col-sm-2">
                <label className="col-form-label">Hierarchie </label>
              </div>
              <div className="col-sm-2">
                <input type="text" className="form-control" readonly=""/>
              </div>
              <div className="col-sm-2">
                <label className="col-form-label">Section </label>
              </div>
              <div className="col-sm-2">
                <input type="text" className="form-control" readonly=""/>
              </div>
              </div>
              <div className="row form-group">
              <div className="col-sm-2">
                <label className="col-form-label">Libellé </label>
              </div>
              <div className="col-sm-10">
                <input type="number" className="form-control" readonly=""/>
              </div>
              </div>
              <div className="row form-group">
              <div className="col-sm-2">
                <label className="col-form-label">Montant * (FCFA)</label>
              </div>
              <div className="col-sm-6">
                <input type="number" className="form-control"/>
              </div>
              </div>
                <div className="text-right col-sm-12">
                  <button type="submit" className="btn btn-primary">Enregistrer</button>
                </div>
                </div>
              </div>
               
              </form>
             
        </div>
      </div>
    </div>
        </div>
      </div>
    </div>
  </section>
     );
}
 
export default CredOuvert;