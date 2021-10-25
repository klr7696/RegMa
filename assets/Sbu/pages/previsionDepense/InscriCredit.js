import axios from 'axios';
import React, { useEffect, useState } from 'react';

const InscriCredit = () => {

    const [creds, setCreds] = useState({
        montantInscription:"",
        estValide : true,
        ressourceFinanciere: "",
        CompteNature: "",
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
        if (!creds.finans) setCreds({...creds, finans:data[0].id} )
        } catch (error) {
        console.log(error.response);
        }
      };
    
      useEffect(() =>{
          fetchFinans();
      }, []);
    
      const handleChange = ({ currentTarget }) => {
        const { name, value } = currentTarget;
        setFinans({...chaps, [name]: value });
      };
      const [search, setSearch] = useState("");

      const handleSearch = ({currentTarget}) => {
          setSearch(currentTarget.value)
      };

      const [natures, setNatures] = useState([]);

    useEffect(() => {
      axios
        .get("http://localhost:8000/api/natures")
        .then(response => response.data["hydra:member"])
        .then(data => setNatures(data));
    }, []);

      const filteredNatures = natures.filter(
          c => c.numeroCompteNature.toLowerCase().includes(search.toLowerCase())
      );

      const handleSubmit = async event => {
        event.preventDefault();
    
        try {
          const response = await axios
          .post("http://localhost:8000/api/ouverts", {...creds,
        finans:`/api/ressources/${creds.finans}`});
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
                href="#/sbu/cred-ouvert/new"
              >
                Création
              </a>
              <div className="slide" />
            </li>
    
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/red-ouver"
              >
                Actualisation
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/cred-ouvert"
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
                    <option value="1">2021</option>
                    <option value="2">2020</option>
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
                <input type="text" onChange={handleSearch} value={search} className="form-control"/>
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
                <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea type="text" className="form-control"/>
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