import axios from "axios";
import React, {useState, useEffect } from "react";
import MairieAPI from "../../../zservices/mairieAPI";

const InscriMairie = ({match, history}) => {
    const {id = "new"} = match.params;

    const [mairie, setMairie] = useState({
      designationMairie: "",
      abbreviationMairie: "",
      adresseMairie: "",
      descriptionMairie:""
      
    });
  
    const [error, setErrors] = useState("");
  
    const [editing, setEditing] = useState (false);
  
    const fetchMairie = async id => {
      try{
    const data = await axios.get("http://localhost:8000/api/mairies/" + id)
    .then(response => response.data);
    
    const { designationMairie, abbreviationMairie, adresseMairie, descriptionMairie } = data;
      
      setMairie({ designationMairie, abbreviationMairie, adresseMairie, descriptionMairie });
      } catch (error) {
      console.log(error.response);
      }
    };
  
    useEffect(() =>{
      if (id !== "new"){
        setEditing(true);
        fetchMairie(id);
      }
    }, [id]);
  
    const handleChange = ({ currentTarget }) => {
      const { name, value } = currentTarget;
      setMairie({...mairie, [name]: value });
    };
  
    const handleSubmit = async event => {
      event.preventDefault();
  
      try {
        if(editing){
         await  MairieAPI.update(id, mairie);
         toast.success("Mairie modifié");
        }else{
          await  MairieAPI.create(mairie);
          toast.error("Mairie Ajoutée");
          history.replace("/mairie");
        }
      } catch(error) {
       console.log(error)
       setErrors("Informations incorrectes")
      }
    };
  
  return (
    <section id="exp">
    <div className="product-detail-page">
      <h3 className="card-header">
        <div className="row">
        <div className="text-left col-sm-6">
       Mairie communale
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
            href="#/admin/mairies/new"
          >
            Enregistrement
          </a>
          <div className="slide" />
        </li>

        <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/admin/mairies"
          >
            Consultation
          </a>
          <div className="slide" />
        </li>

      </ul>
      <div className="card">
        <div className="card-block">
          <div className="tab-content bg-white">
            <div className="tab-pane active" id="enregistrement" role="tabpanel">
            </div>
            <div className="tab-pane" id="consultation" role="tabpanel">
            </div>
          </div>
          <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          <div className="card-block">
          <form onSubmit={handleSubmit}>
        
         { /* <div className="card-header text-center">
               {!editing && <h3>Création</h3> || <h3>Modifier</h3>}
              </div>*/}
            <div className="row form-group">
              <div className="col-sm-2">
                <label className="col-form-label">Désignation *</label>
              </div>
              <div className="col-sm-5">
                <input
                  name="designationMairie"
                  type="text"
                  className={"form-control required" + (error && " is-invalid")}
                  value={mairie.designationMairie}
                  onChange={handleChange}
                  required
                />
                {error && <p className="invalid-feedback">
               {error}
              </p>}
              </div>
              <div className="col-sm-2">
                  <label className="col-form-label">Abbreviation *</label>
                </div>
                <div className="col-sm-3">
                  <input
                    name="abbreviationMairie"
                    type="text"
                    className="required form-control"
                    value={mairie.abbreviationMairie}
                    onChange={handleChange}
                    required
                  />
                </div>
            </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Adresse *</label>
                </div>
                <div className="col-sm-10">
                  <input
                    name="adresseMairie"
                    type="text"
                    className="form-control"
                    value={mairie.adresseMairie}
                    onChange={handleChange}
                    required
                  />
                </div>
              </div>
            
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea
                    name="descriptionMairie"
                    type="text"
                    className="form-control"
                    value={mairie.descriptionMairie}
                    onChange={handleChange}
                  />
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button type="submit" className="btn btn-primary">{!editing && "Enregistrer" || "Modifier"}</button>
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
};
export default InscriMairie;
