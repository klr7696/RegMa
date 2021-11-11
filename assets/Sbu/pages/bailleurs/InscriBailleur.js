import axios from "axios";
import React, {useState, useEffect } from "react";
import BailleurAPI from "../../../zservices/bailleurAPI"
import OuvriExerc from "../Exercice/OuvriExerc";

const InscriBailleur = (props) => {
  const { id = "new" } = props.match.params;

  const [bailleurs, setBailleurs] = useState({
    designationBailleur: "",
    sigleBailleur: "",
    categorieBailleur: "",
    codeBailleur: "",
    sourceFinancement: "",
    descriptionBailleur: ""
    
  });

  const [error, setErrors] = useState("");

  const [editing, setEditing] = useState (false);

  const fetchBailleur = async id => {
    try{
  const data = await axios.get("http://localhost:8000/api/bailleurs/" + id)
  .then(response => response.data);
  
  const { designationBailleur, sigleBailleur, categorieBailleur, codeBailleur,
    sourceFinancement, descriptionBailleur } = data;
    
    setBailleurs({ designationBailleur, sigleBailleur, categorieBailleur, codeBailleur,
    sourceFinancement, descriptionBailleur });
    } catch (error) {
    console.log(error.response);
    }
  };

  useEffect(() =>{
    if (id !== "new"){
      setEditing(true);
      fetchBailleur(id);
    }
  }, [id]);

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setBailleurs({...bailleurs, [name]: value });
  };

  const handleSubmit = async event => {
    event.preventDefault();

    try {
      if(editing){
       await  BailleurAPI.update(id, bailleurs);
      }else{
        await  BailleurAPI.create(bailleurs);
      }
    } catch(error) {
     console.log(error)
     setErrors("Informations incorrectes")
    }
  };
  return (
    <section id="exp">
    <div className="product-detail-page">
    <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-8">
           Bailleur de fonds
            </div>
            <OuvriExerc/>
            </div>
          </h4>
      <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
        <li className="nav-item">
          <a
            className="nav-link active f-18 p-b-0"
            href="#/sbu/bailleurs/new"
          >
            Enregistrement
          </a>
          <div className="slide" />
        </li>

        <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/bailleurs"
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
              <div className="col-sm-4">
                <input
                  name="designationBailleur"
                  type="text"
                  className={"form-control required" + (error && " is-invalid")}
                  value={bailleurs.designationBailleur}
                  onChange={handleChange}
                  data-v-max="9999" data-v-min="0"
                  required
                />
                {error && <p className="invalid-feedback">
               {error}
              </p>}
              </div>
              <div className="col-sm-2">
                  <label className="col-form-label">Sigle *</label>
                </div>
                <div className="col-sm-4">
                  <input
                    name="sigleBailleur"
                    type="text"
                    className="required form-control"
                    value={bailleurs.sigleBailleur}
                    onChange={handleChange}
                    required
                  />
                </div>
            </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Catégorie *</label>
                </div>
                <div className="col-sm-4">
                  <input
                    name="categorieBailleur"
                    type="text"
                    className="form-control"
                    value={bailleurs.categorieBailleur}
                    onChange={handleChange}
                    required
                  />
                </div>
                <div className="col-sm-2">
                  <label className="col-form-label">Code *</label>
                </div>
                <div className="col-sm-4">
                  <input
                    name="codeBailleur"
                    type="text"
                    className="form-control"
                    value={bailleurs.codeBailleur}
                    onChange={handleChange}
                    required
                  />
                </div>
              </div>
              <div className="row form-group">
              <div className="col-sm-2">
                  <label className="col-form-label">Source financement *</label>
                </div>
                <div className="col-sm-10">
                  <input
                  name="sourceFinancement"
                    type="text"
                    className="form-control"
                    value={bailleurs.sourceFinancement}
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
                    name="descriptionBailleur"
                    type="text"
                    className="form-control"
                    value={bailleurs.descriptionBailleur}
                    onChange={handleChange}
                    
                  />
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button type="submit" className="btn btn-primary">{!editing && "Création" || "Modifier"}</button>
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
export default InscriBailleur;
