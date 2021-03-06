import axios from "axios";
import React, {useState, useEffect} from "react";
import { toast } from "react-toastify";
import ExercAPI from "../../../zservices/exercAPI";
import OuvriExerc from "./OuvriExerc";

const InscriExerc = ( {history,match}) => {

 const { id = "new" } = match.params;

  const [exercs, setExercs] = useState({
    anneeExercice: 2021,
    ordonateurExercice: "",
    dateVote: "",
    dateAdoption: "",
    description: "",
    nomenclature: ""
  });

const [nomenclatures, setNomens] = useState([]);
const [editing, setEditing] = useState (false);

  const fetchExers = async id => {
    try{
  const data = await axios.get("http://localhost:8000/api/registres/" + id)
  .then(response => response.data);
  
  const { anneeExercice, ordonateurExercice, dateVote, dateAdoption,
    description, nomenclature } = data;
    
    setExercs({ anneeExercice, ordonateurExercice, dateVote, dateAdoption,
      description, nomenclature });
    } catch (error) {
    console.log(error);
    toast.error("Exercice non trouvée");
    }
  };

  useEffect(() =>{
    if (id !== "new"){
      setEditing(true);
      fetchExers(id);
    }
  }, [id]);
    
  const fetchNomen = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/nomenclatures")
  .then(response => response.data["hydra:member"]);
    setNomens(data);
    if (!exercs.nomenclature) setExercs({...exercs, nomenclature:data[0].id} )
    } catch (error) {
    console.log(error);
    }
  };

  useEffect(() =>{
      fetchNomen();
  }, []);
  
  const [error, setError] = useState("");

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setExercs({...exercs, [name]: value });
  };

  const handleSubmit = async event => {
    event.preventDefault();

    try {
      if(editing){
       await  ExercAPI.update(id, exercs);
       toast.success("Exercice Modifié");
       history.replace("/sbu/exercice");
      }else{
        const response = await  ExercAPI.create({...exercs, nomenclature:`/api/nomenclatures/${exercs.nomenclature}`});
       toast.success("Exercice Ajouté");
       history.replace("/sbu/exercice");
       console.log(response.data);
    } 
  }catch(error) {
         console.log(error.response);
          setError("Existe déjà")
          toast.error("Exercice Non Ajouté");
    }
  };

  return (
    <section id="exp">
    <div className="product-detail-page">
    <h3 className="card-header">
            <div className="row">
            <div className="text-left col-sm-8">
            Exercice
            </div>
            <OuvriExerc/>
            </div>
          </h3>
      <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
        <li className="nav-item">
          <a
            className="nav-link active f-18 p-b-0"
            href="#/sbu/exercice/new"
          >
            Ouverture
          </a>
          <div className="slide" />
        </li>
        <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/modif-exercice"
          >
            Modification
          </a>
          <div className="slide" />
        </li>
         <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/clos-exercice"
          >
            Clôture
          </a>
          <div className="slide" />
        </li>
        <li className="nav-item m-b-0">
          <a
            className="nav-link f-18 p-b-0"
            href="#/sbu/exercice"
          >
            Consultation
          </a>
          <div className="slide" />
        </li>
      </ul>
   <div className="page-body">
  <div className="row">
    <div className="col-md-12">
      <div className="card table-card">
        <div className="card-header">
        <form onSubmit={handleSubmit}>
        <div className="row form-group">
          <div className="col-sm-2">
            <label className="col-form-label">Année *</label>
          </div>
          <div className="col-sm-3">
            <input
              name="anneeExercice"
              type="number"
              className={"form-control required" + (error && " is-invalid")}
              value={exercs.anneeExercice}
              onChange={handleChange}
            />
            {error && <p className="invalid-feedback">{error}</p>}
          </div>
          <div className="col-sm-2">
              <label className="col-form-label">Nomenclature</label>
            </div>
              <div className="col-sm-3">
              <select 
              disabled="disabled"
              onChange={handleChange} 
              name="nomenclature"
              id="nomenclature"
              value={exercs.nomenclature}
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
            <label className="col-form-label">Ordonnateur *</label>
          </div>
          <div className="col-sm-10">
            <input
              name="ordonateurExercice"
              type="text"
              className={"form-control form-control-capitalize required" + (error && " is-invalid")}
              value={exercs.ordonateurExercice}
              onChange={handleChange}
            />
            {error && <p className="invalid-feedback">{error}</p>}
          </div>
        </div>
        <div className="row form-group">
          <div className="col-sm-2">
            <label className="col-form-label">Date de vote *</label>
          </div>
          <div className="col-sm-4">
            <input
              id="dateVote"
              name="dateVote"
              type="date"
              className={"form-control required" + (error && " is-invalid")}
              value={exercs.dateVote}
              onChange={handleChange}
            />
            {error && <p className="invalid-feedback">{error}</p>}
          </div>
       
          <div className="col-sm-2">
            <label className="col-form-label">Date d'adoption *</label>
          </div>
          <div className="col-sm-4">
            <input
              id="dateAdoption"
              name="dateAdoption"
              type="date"
              className={"form-control required" + (error && " is-invalid")}
              value={exercs.dateAdoption}
              onChange={handleChange}
            />
            {error && <p className="invalid-feedback">{error}</p>}
          </div>
        </div>
        <div className="row form-group">
          <div className="col-sm-2">
            <label className="col-form-label">Description</label>
          </div>
          <div className="col-sm-10">
            <textarea 
            id="description"
            name="description"
            type="text" 
            className={"form-control required" + (error && " is-invalid")} 
             value={exercs.description}
              onChange={handleChange}
            />
            {error && <p className="invalid-feedback">{error}</p>}
          </div>
        </div>
        <div className="text-right col-sm-12">
          <button 
          type="submit" 
          className="btn btn-primary"
          >
            {( <>Ouvrir</>)}
          </button>
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

export default InscriExerc ;
