import axios from "axios";
import React, {useEffect, useState } from "react";
import { toast } from "react-toastify";

const InscriChap = () => {
    const [chaps, setChaps] = useState({
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
          toast.error("Nomenclature inexistante");
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
        toast.success(`Chapitre ${chaps.numeroCompteNature} Ajoutée`);
          console.log(response.data);
        } catch(error) {
          console.log(error.response);
           setErrors("Inexiste")
          toast.error("Chapitre Non Ajouté");
        }
       
      };
    
    return ( 
      <section id="exp">
      <div className="product-detail-page">
        <h3 className="card-header">
          <div className="row">
          <div className="text-left col-sm-6">
          Chapitre
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
                      type="number"
                      className="form-control"
                      placeholder="**"
                      data-v-max={99}
                      data-v-min={0}
                      className={"form-control required" + (error && " is-invalid")}
                    value={chaps.numeroCompteNature}
                    onChange={handleChange}
                    />
                  </div>
                 <div className="col-sm-1">
                    <label className="col-form-label">Section *</label>
                  </div>
                    <div className="col-sm-3">
                    <select 
                    onChange={handleChange} 
                    name="sectionCompteNature"
                    id="sectionCompteNature"
                    value={chaps.sectionCompteNature}
                    className={"form-control" + (error && " is-invalid")}
                   >
                      <option value="Fonctionnement">Fonctionnement</option>
                      <option value="Investissement">Investissement</option>
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
                    value={chaps.nomenclature}
                    className={"form-control" + (error && " is-invalid")}
                    error={chaps.nomenclature}
                   >
                     {nomenclatures.map(nomenclature => <option key={nomenclature.id} value={nomenclature.id}>
                       {nomenclature.anneeApplication}
                     </option>)}
                      </select>
                       {error && <p className="invalid-feedback">{error}</p>}
                    </div>
                </div>
                <div className="row form-group">
                  <div className="col-sm-2">
                    <label className="col-form-label">Libellé *</label>
                  </div>
                  <div className="col-sm-10">
                    <input 
                    name="libelleCompteNature"
                    type="text"
                     className={"form-control " + (error && " is-invalid")}
                    value={chaps.libelleCompteNature}
                    onChange={handleChange}
                    />
                  </div>
                </div>
                <div className="row form-group">
                  <div className="col-sm-2">
                    <label className="col-form-label">Description</label>
                  </div>
                  <div className="col-sm-10">
                    <textarea 
                    name="descriptionCompteNature"
                    type="text" 
                     className={"form-control" + (error && " is-invalid")}
                    value={chaps.descriptionCompteNature}
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
 
export default InscriChap;