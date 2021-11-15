import axios from "axios";
import React, {useEffect, useState } from "react";
import { toast } from "react-toastify";
import OuvriExerc from "../../../Sbu/pages/Exercice/OuvriExerc";

const InscriDivision = () => {
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
          toast.error("Chapitre Non Ajouté");
           setErrors("Inexiste")
        }
       
      };
    
    return ( 
      <section id="exp">
      <div className="product-detail-page">
      <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-8">
           Division
            </div>
            <OuvriExerc/>
            </div>
          </h4>
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
            <form>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Numéro
                  </label>
                </div>
                <div className="col-sm-2">
                  <input
                    type="text"
                    className="form-control autonumber"
                    placeholder="**"
                    data-v-max={99}
                    data-v-min={0}
                  />
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Libellé *</label>
                </div>
                <div className="col-sm-10">
                  <input type="text" className="form-control" />
                </div>
              </div>
             
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea type="text" className="form-control" />
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
 
export default InscriDivision;