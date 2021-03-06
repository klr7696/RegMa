import axios from "axios";
import React, {useEffect, useState } from "react";
import { toast } from "react-toastify";

const InscriArt = () => {

    const [arts, setArts] = useState({

        numeroCompteNature: "",
        libelleCompteNature : "",
        hierachieCompteNature: "Article",
        descriptionCompteNature: "",
        compteNature:""
      });
    
      const [error, setErrors] = useState("");
      const [compteNatures, setCompteNatures] = useState([]);
      const [nomenclatures, setNomens] = useState([]);
    
      const fetchCompteNatures = async () => {
        try{
      const data = await axios
      .get("http://localhost:8000/api/natures?hierachieCompteNature=Chapitre")
      .then(response => response.data["hydra:member"]);
        setCompteNatures(data);
        if (!arts.compteNature) setArts({...arts, compteNature:data[0].id} )
        } catch (error) {
        console.log(error.response);
        }
      };
    
      useEffect(() =>{
          fetchCompteNatures();
      }, []);

      const fetchNomen = async () => {
        try{
      const data = await axios
      .get("http://localhost:8000/api/nomenclatures?estActif=true")
      .then(response => response.data["hydra:member"]);
        setNomens(data);
        } catch (error) {
        console.log(error.response);
        }
      };
    
      useEffect(() =>{
          fetchNomen();
      }, []);
    
      const handleChange = ({ currentTarget }) => {
        const { name, value } = currentTarget;
        setArts({...arts, [name]: value });
      };
    
      const handleSubmit = async event => {
        event.preventDefault();
    
        try {
          const response = await axios
          .post("http://localhost:8000/api/natures/sousnatures", {...arts,
        compteNature:`/api/natures/${arts.compteNature}`});
          console.log(response.data);
          toast.success(`Article ${arts.numeroCompteNature} Ajoutée`)
        } catch(error) {
          console.log(error.response);
          setErrors("Erreur de Saisie")
          toast.error("Article Non Ajouté");
        }
      };
     
      return (
        <section id="exp">
      <div className="product-detail-page">
        <h3 className="card-header">
          <div className="row">
          <div className="text-left col-sm-6">
          Article
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
              className="nav-link active f-18 p-b-0"
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
           
            <div className="card-block">
              <form onSubmit={handleSubmit}>
                  <div className="row form-group">
                    <div className="col-sm-2">
                      <label className="col-form-label">
                        Numéro *
                      </label>
                    </div>
                    <div className="col-sm-2">
                      <input
                        name="numeroCompteNature"
                        type="text"
                        className="form-control autonumber"
                        placeholder="***"
                        data-v-max={999}
                        data-v-min={0}
                        className={"form-control required" + (error && " is-invalid")}
                        value={arts.numeroCompteNature}
                        onChange={handleChange}
                      />
                    </div>
                 
                    <div className="col-sm-2">
                      <label className="col-form-label">
                        Numéro du Chapitre *
                      </label>
                    </div>
                    <div className="col-sm-2">
                      <select 
                      onChange={handleChange} 
                      name="compteNature"
                      id="compteNature"
                      value={arts.compteNature}
                      className={"form-control" + (error && " is-invalid")}
                     >
                       {compteNatures.map(compteNature => <option key={compteNature.id} value={compteNature.id}>
                         {compteNature.numeroCompteNature}
                       </option>)}
                        </select>
                      </div>
                      <div className="col-sm-2">
                    <label className="col-form-label">Nomenclature</label>
                  </div>
                    <div className="col-sm-2">
                    <select 
                    disabled="disabled"
                    onChange={handleChange} 
                    name="nomenclature"
                    id="nomenclature"
                    value={arts.nomenclature}
                    className={"form-control" + (error && " is-invalid")}
                   >
                     {nomenclatures.map(nomenclature => <option key={nomenclature.id} value={nomenclature.id}>
                       {nomenclature.anneeApplication}
                     </option>)}
                      </select>
                    </div>
                  </div>
                  <div className="row form-group">
                    <div className="col-sm-2">
                      <label className="col-form-label">Libellé *</label>
                    </div>
                    <div className="col-sm-10">
                      <input name="libelleCompteNature" type="text" className="form-control" 
                       className={"form-control required" + (error && " is-invalid")}
                       value={arts.libelleCompteNature}
                       onChange={handleChange}
                      />
                    </div>
                  </div>
                  <div className="row form-group">
                    <div className="col-sm-2">
                      <label className="col-form-label">Description</label>
                    </div>
                    <div className="col-sm-10">
                      <textarea name="descriptionCompteNature" type="text" className="form-control" 
                       className={"form-control required" + (error && " is-invalid")}
                        value={arts.descriptionCompteNature}
                        onChange={handleChange}
                      />
                    </div>
                  </div>
                  <div className="text-right col-sm-12">
                    <button type="submit" className="btn btn-primary">Enregistrer</button>
                  </div>
                </form>
                </div>
        </div>
      </div>
    </div>
        </div>
      </div>
    </div>
  </section>
     );
}
 
export default InscriArt;