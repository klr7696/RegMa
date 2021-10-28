import axios from "axios";
import React, {useState, useEffect } from "react";
import { toast } from "react-toastify";
import NomenAPI from "../../../zservices/nomenAPI";

const InscriNomen = ({history,match}) =>{

  const { id = "new" } = match.params;

  const [nomens, setNomens] = useState({
    anneeApplication: "",
    decretAdoption: "",
    dateAdoption: "",
    decretApplication: "",
    dateApplication: "",
    descriptionNomenclature: ""
  });

  const [error, setError] = useState("");
  const [editing, setEditing] = useState (false);

  const fetchNomen = async id => {
    try{
  const data = await axios.get("http://localhost:8000/api/nomenclatures/" + id)
  .then(response => response.data);
  
  const { anneeApplication, decretAdoption, dateAdoption, decretApplication,
    dateApplication, descriptionNomenclature } = data;
    
    setNomens({ anneeApplication, decretAdoption, dateAdoption, decretApplication,
      dateApplication, descriptionNomenclature });
    } catch (error) {
    console.log(error.response);
    }
  };

  useEffect(() =>{
    if (id !== "new"){
      setEditing(true);
      fetchNomen(id);
    }
  }, [id]);

  const [nabrog, setNabrog] = useState([]);

  const fetchNabrog = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/nomenclatures?estActif=true")
  .then(response => response.data["hydra:member"]);
  setNabrog(data);
  if (!nomens.nabro) setNomens({...nomens, nabro:data[0].id} )
    } catch (error) {
    console.log(error.response);
    }
  };

  useEffect(() =>{
      fetchNabrog();
  }, []);
  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setNomens({...nomens, [name]: value });
  };

 

  const handleSubmit = async event => {
    event.preventDefault();

    try {
      if(editing){
       await  NomenAPI.update(id, nomens);
      }else{
       // res.data.headers['application/merge-patch+json'];
        await  NomenAPI.create(nomens);
        await axios.patch("http://localhost:8000/api/nomenclatures/" + nomens.nabro , {});
        toast.success("Livre Ajouté");
        history.replace("/sbu/nomenclature");
      console.log(nomens.nabro);
      }
    } catch(response) {
         console.log(error);
       toast.error("Livre Ajouté");
    }
   
  };

  return (
    <section id="exp">
    <div className="product-detail-page">
      <h3 className="card-header">
        <div className="row">
        <div className="text-left col-sm-6">
        NOMENCLATURE
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
            href="#/sbu/nomenclature/new"
          >
            Enregistrement
          </a>
          <div className="slide" />
        </li>

        <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/nomenclature"
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
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Année de mise en application *
                  </label>
                </div>
                <div className="col-sm-2">
                  <input
                    name="anneeApplication"
                    type="number"
                    className={"form-control" + (error && " is-invalid")}
                    placeholder="2021"
                    value={nomens.anneeApplication}
                    onChange={handleChange}
                    required
                    error={error.anneeApplication}
                  />
                </div>
                <div className="col-sm-2">
                  <label className="col-form-label">
                   Nomenclature abrogée
                  </label>
                </div>
                <div className="col-sm-2">
                  <select 
                  disabled="disabled"
                  onChange={handleChange} 
                  name="nabro"
                  id="nabro"
                  value="bold"
                  className="form-control"
                 >
                   {nabrog.map(nabro => <option key={nabro.id} value={nabro.id}>
                     {nabro.anneeApplication}
                   </option>)}
                    </select>
                  </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Décret d'adoption *</label>
                </div>
                <div className="row col-sm-10">
                  <div className="col-sm-9">
                    <input
                      name="decretAdoption"
                      type="text"
                      className="form-control"
                      value= {nomens.decretAdoption}
                      onChange={handleChange}
                      required
                      error={error.decretAdoption}
                    />
                  </div>
                  <div className="col-sm-3">
                    <input 
                    name="dateAdoption"
                    type="date" 
                    className="form-control" 
                    value={nomens.dateAdoption}
                    onChange={handleChange}
                    required
                    />
                  </div>
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Décret d'application *
                  </label>
                </div>
                <div className="row col-sm-10">
                  <div className="col-sm-9">
                    <input 
                    name="decretApplication"
                    type="text" 
                    className="form-control" 
                    value={nomens.decretApplication}
                    onChange={handleChange}
                    required
                    />
                  </div>
                  <div className="col-sm-3">
                    <input 
                    name="dateApplication"
                    type="date"
                    className="form-control"
                    value={nomens.dateApplication.toLocaleString('fr-FR', { timeZone: 'UTC' })}
                    onChange={handleChange}
                    required
                     />
                  </div>
                </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea
                  name="descriptionNomenclature" 
                  type="text" 
                  className="form-control" 
                  value={nomens.descriptionNomenclature}
                  onChange={handleChange}
                  />
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button type="submit" className="btn btn-primary">
                  Créer
                </button>
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

export default InscriNomen ;
