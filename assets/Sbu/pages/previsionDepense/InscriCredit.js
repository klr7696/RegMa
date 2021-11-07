import axios from 'axios';
import React, { useEffect, useState } from 'react';

const InscriCredit = () => {

    const [creds, setCreds] = useState({
        montantInscription:"",
        ressourceFinanciere: "",
        compteNature: "",
        descriptionInscription: ""
      });
    
      const [error, setErrors] = useState("");

      const [finans, setFinans] = useState([]);
    
      const fetchFinans = async () => {
        try{
      const data = await axios
      .get("http://localhost:8000/api/ressources")
      .then(response => response.data["hydra:member"]);
        setFinans(data);
        } catch (error) {
        console.log(error.response);
        }
      };
    
      useEffect(() =>{
          fetchFinans();
      }, []);
    
      const handleChange = ({ currentTarget }) => {
        const { name, value } = currentTarget;
        setCreds({...creds, [name]: value });
      };
      const [status, setStatus] = useState([]);

  const fetchStatus = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/registat/actif")
  .then(response => response.data["hydra:member"]);
  setStatus(data)
    } catch (error) {
    console.log(error);
    }
  };

  useEffect(() =>{
      fetchStatus();
  }, []);

    const [natures, setNatures] = useState([]);

    const fetchNatures = async () => {
      try{
    const data = await axios
    .get("http://localhost:8000/api/natures")
    .then(response => response.data["hydra:member"]);
      setNatures(data);
     if (!creds.compteNature) setCreds({...creds, compteNature:data[0].id} )
      } catch (error) {
      console.log(error.response);
      }
    };

    useEffect(() => {
      fetchNatures();
    }, []);

      const handleSubmit = async event => {
        event.preventDefault();
        console.log(creds)
    
       try {
          const response = await axios
          .post("http://localhost:8000/api/ouverts/inscription",
           {...creds,
        ressourceFinanciere:`/api/ressources/${creds.ressourceFinanciere}`,
        compteNature:`/api/natures/${creds.compteNature}`}
       );
          console.log(response.data);
        } catch(error) {
          console.log(error.response);
          setErrors("Erreur de Saisie")
        }
      };

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
                href="#/sbu/credit-ouvert/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
    
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/cred-ouver"
              >
                Actualisation
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/credit-ouvert"
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
             
             
                <form onSubmit={handleSubmit} >
               
                <div className="card">
                <div className="card-block">
                  <div className="row form-group">
                    <div className="col-sm-2">
                  <label className="col-form-label">Bailleur *</label>
                    </div>
                    <div className="col-sm-4">
                    <select 
                 // disabled="disabled"
                  onChange={handleChange} 
                  name="ressourceFinanciere"
                  id="ressourceFinanciere"
                  value={creds.ressourceFinanciere}
                  className="form-control"
                 > <option value="">Choisir ...</option>
                   {finans.map(finan => <option key={finan.id} value={finan.id}>
                     {finan.id}
                   </option>)}
                    </select>
                    </div>
                    <div className="col-sm-2">
                   <label className="col-form-label">Objet *</label>
                    </div>
                    <div className="col-sm-4">
                  <select 
                   disabled="disabled"
                  onChange={handleChange} 
                  name="ressourceFinanciere"
                  id="ressourceFinanciere"
                  value={creds.ressourceFinanciere}
                  className="form-control"
                 ><option value="">...</option>
                   {finans.map(finan => <option key={finan.id} value={finan.id}>
                     {finan.objetFinancement}
                   </option>)}
                    </select>
                   </div>
                    
                  </div>
                  <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Montant (FCFA)</label>
                </div>
                <div className="col-sm-4">
                  <select 
                   disabled="disabled"
                  onChange={handleChange} 
                  name="ressourceFinanciere"
                  id="ressourceFinanciere"
                  value={creds.ressourceFinanciere}
                  className="form-control"
                 ><option value="">...</option>
                   {finans.map(finan => <option key={finan.id} value={finan.id}>
                     {finan.objetFinancement}
                   </option>)}
                    </select>
                   </div>
                   <div className="col-sm-2">
                  <label className="col-form-label">Exercice</label>
                </div>
                <div className="col-sm-4">
                    <select 
                  disabled="disabled"
                  id="exerciceRegistre"
                    onChange={handleChange} 
                    name="exerciceRegistre"
                    className={"form-control"}
                   >
                     {status.map(exerc => <option key={exerc.id} value={exerc.id}>
                       {exerc.statut} {exerc.exerciceRegistre.anneeExercice}
                     </option>)}
                      </select>
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
                  <select 
                  onChange={handleChange} 
                  name="CompteNature"
                  id="CompteNature"
                  value={creds.CompteNature}
                  className="form-control"
                 >
                   {natures.map(nature => <option key={nature.id} value={nature.id}>
                     {nature.numeroCompteNature}
                   </option>)}
                    </select>
                   </div>
             
                <div className="col-sm-2">
                  <label className="col-form-label">Hierarchie </label>
                </div>
                <div className="col-sm-2">
                  <select 
                 disabled="disabled"
                  name="CompteNature"
                  className="form-control"
                  value={creds.CompteNature}
                 >
                   {natures.map(nature => <option key={nature.id} value={nature.id}>
                     {nature.hierachieCompteNature}
                   </option>)}
                    </select>
                   </div>
                <div className="col-sm-2">
                  <label className="col-form-label">Section </label>
                </div>
                <div className="col-sm-2">
                  <select 
                  disabled="disabled"
                  name="CompteNature"
                  className="form-control"
                  value={creds.compteNature}
                 >
                   {natures.map(nature => <option key={nature.id} value={nature.id}>
                     {nature.sectionCompteNature}
                   </option>)}
                    </select>
                   </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Libellé </label>
                </div>
                <div className="col-sm-8">
                  <select 
                 disabled="disabled"
                  name="CompteNature"
                  className="form-control"
                  value={creds.compteNature}
                 >
                   {natures.map(nature => <option key={nature.id} value={nature.id}>
                     {nature.libelleCompteNature}
                   </option>)}
                    </select>
                   </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Montant * (FCFA)</label>
                </div>
                <div className="col-sm-3">
                  <input 
                  id="montantInscription"
                  type="number"
                  name="montantInscription"
                  value={creds.montantInscription}
                  onChange={handleChange}
                  className={"form-control" + (error && " is-invalid")} />
                </div>
                </div>
                <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea
                    onChange={handleChange} 
                    name="descriptionInscription"
                    id="descriptionInscription"
                    value={creds.descriptionInscription}
                    type="text"
                    className="form-control"
                  />
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
};

export default InscriCredit;