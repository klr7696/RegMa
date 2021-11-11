import axios from "axios";
import React, {useState, useEffect} from "react";
import OuvriExerc from "./OuvriExerc";

const ModifExerc = () =>{

  const [modifs, setModifs] = useState({
    statut: "Primitif modificatif",
    exerciceRegistre: "",
    dateApprobation: "",
    descriptionStatut: ""
  });
  
  const [exercs, setExercs] = useState([]);
    
  const fetchExerc = async () => {

    try{
  const data = await axios
  .get("http://localhost:8000/api/registat/actif?estEncours=true&exerciceResgistre.estOuvert=true&statut=Primitif")
  //.then(reponse => console.log(reponse));
  .then(response => response.data['hydra:member'])
   setExercs(data);
    if (!modifs.exerciceRegistre) setModifs({...modifs, exerciceRegistre:data[0].exerciceRegistre.id} )
    } catch (error) {
    console.log(error.data);
    }
  };
  useEffect(() =>{
    fetchExerc();
}, []);

  const [error, setErrors] = useState("");

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setModifs({...modifs, [name]: value });
  };

  const handleSubmit = async event => {
    event.preventDefault();
    try {
     const response = await axios
      .post("http://localhost:8000/api/registres/changerstatut",  {...modifs,
        exerciceRegistre:`/api/registres/${modifs.exerciceRegistre}`
    }  )
      console.log(response.data);
    } catch(error) {
     console.log(error.response);
     setErrors("Informations incorrectes")
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
            className="nav-link f-18 p-b-0"
            href="#/sbu/exercice/new"
          >
            Ouverture
          </a>
          <div className="slide" />
        </li>
        <li className="nav-item m-b-0">
          <a
            className="nav-link active f-18 p-b-0"
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
      <div className="card">
        <div className="card-block">
          <div className="page-body">
             <div className="row">
              <div className="col-sm-12">
                <div className="card-block">
                 <form onSubmit={handleSubmit}>
                   <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Exercice en cours</label>
                </div>
                <div className="col-sm-4">
                  <select 
                  name="exerciceRegistre"
                  onChange={handleChange}
                  value={modifs.exerciceRegistre}
                  className=" form-control">
                 {exercs.map(exerc => 
                 <option key={exerc.id} value={exerc.id}>
                {exerc.statut} {exerc.exerciceRegistre.anneeExercice}
               </option>)}  
                  </select>
                  </div>

                  <div className="col-sm-2">
                  <label className="col-form-label">Type de modification</label>
                </div>
                <div className="col-sm-4">
                  <select 
                  name="statut"
                  className="form-control"
                  value={modifs.statut}
                  onChange={handleChange}
                  >
                    <option value="Modificatif">Primitif modificatif</option>
                    <option value="Supplémentaire">Supplémentaire</option>
                  </select>
                </div>
                </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Date d'approbation *</label>
                </div>
                <div className="col-sm-4">
                  <input  
                  type="date"
                  name="dateApprobation" 
                  className="form-control"
                  value={modifs.dateApprobation}
                  onChange={handleChange}/>
                </div>
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Motif de modification *
                  </label>
                </div>
                <div className="col-sm-4">
                  <textarea 
                  type="text"
                  name="descriptionStatut" 
                  className="form-control"
                  value={modifs.descriptionStatut}
                  onChange={handleChange}
                   />
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button type="submit" className="btn btn-primary">
                  Modifier
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

export default ModifExerc ;
