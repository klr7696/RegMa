import axios from "axios";
import React, {useState, useEffect } from "react";
import BailleurAPI from "../../zservices/bailleurAPI";


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
  const data = await axios.get("http://localhost:8000/api/bailleur_fonds" + id)
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
    <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          {!editing && <h1>Creation</h1> || <h1>Modifier</h1>}
          <div className="card-block">
          <form onSubmit={handleSubmit}>
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
                <button type="submit" className="btn btn-primary">Enregistrer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default InscriBailleur;
