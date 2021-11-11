import axios from "axios";
import React, {useState, useEffect } from "react";
import MairieAPI from "../../../zservices/mairieAPI";

const InscriProfils = ({match, history}) => {
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
              <div className="row form-group">
                <div className="col-sm-1">
                  <label className="col-form-label">Nom*</label>
                </div>
                <div className="col-sm-5">
                  <input
                    type="text"
                    className="required form-control"
                  />
                </div>
                <div className="col-sm-1">
                    <label className="col-form-label">Prénom*</label>
                  </div>
                  <div className="col-sm-5">
                    <input
                      type="text"
                      className="required form-control"
                    />
                  </div>
              </div>

              <div className="row form-group">
                <div className="col-sm-1">
                  <label className="col-form-label">Matricule*</label>
                </div>
                <div className="col-sm-5">
                  <input
                    type="text"
                    className="form-control"
                  />
                </div>
                <div className="col-sm-1">
                    <label className="col-form-label">Confirmer Matricule*</label>
                  </div>
                  <div className="col-sm-5">
                    <input
                      type="text"
                      className="form-control"
                    />
                  </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-1">
                  <label className="col-form-label">Email*</label>
                </div>
                <div className="col-sm-5">
                  <input
                    type="email"
                    className="form-control"
                  />
                </div>
                <div className="col-sm-1">
                    <label className="col-form-label">Téléphone</label>
                  </div>
                  <div className="col-sm-5">
                    <input
                      type="text"
                      className="form-control"
                    />
                  </div>
              </div>

                <div className="row form-group">
                  <div className="col-sm-1">
                    <label className="col-form-label">Mairie*</label>
                  </div>
                  <div className="col-sm-5"> 
                  <select className="form-control">
                    <option value="none">Mairie...</option>
                    <option value="1">Mairie centale</option>
                    <option value="1">Arrondissement 1</option>
                  </select>
                  </div>
                  <div className="col-sm-1">
                    <label className="col-form-label">Rôle*</label>
                  </div>
                  <div className="col-sm-5">
                  <select className="form-control">
                                 <option value="1">Rôle...</option>
                                <option value="1">Agent SBU</option>
                                <option value="2">Agent SDE</option>
                </select>
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
};
export default InscriProfils;
