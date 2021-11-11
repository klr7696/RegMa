import axios from 'axios';
import React, { useEffect, useState } from 'react';
import OuvriExerc from '../Exercice/OuvriExerc';

const InscriRessource = (props) => {
 
  const { id = "new" } = props.match.params;

  const [finans, setFinans] = useState({
      objetFinancement: "Fonctionnement",
      modeFinancement: "Subvention",
      montantFinancement: "",
      descriptionFinancement: "",
      exerciceRegistre: "",
      bailleurFonds: "",
      statutRegistre:""
  });

  const [error, setErrors] = useState("");
  const [editing, setEditing] = useState (false);

 const fetchFinans = async id => {
    try{
  const data = await axios.get("http://localhost:8000/api/ressources/" + id)
  .then(response => response.data);
  
  const { objetFinancement, modeFinancement, montantFinancement, exerciceRegistre,
      bailleurFonds, descriptionFinancement } = data;
    
    setFinans({ objetFinancement, modeFinancement, montantFinancement, exerciceRegistre,
      bailleurFonds, descriptionFinancement});
    } catch (error) {
    console.log(error.response);
    }
  };

  useEffect(() =>{
    if (id !== "new"){
      setEditing(true);
      fetchFinans(id);
    }
  }, [id]);

 const [bailleurs, setBailleurs] = useState([]);

  const fetchBailleurs = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/bailleurs")
  .then(response => response.data["hydra:member"]);
  setBailleurs(data)
  if(!finans.bailleurFonds) setFinans({...finans, bailleurFonds:data[0].id})
    } catch (error) {
    console.log(error.response);
    }
  };

  useEffect(() =>{
      fetchBailleurs();
  }, []);

  const [status, setStatus] = useState([]);

  const fetchStatus = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/registat/actif")
  .then(response => response.data["hydra:member"]);
  setStatus(data)
  if (!finans.statutRegistre, !finans.exerciceRegistre) setFinans({...finans, 
    exerciceRegistre:data[0].exerciceRegistre.id, statutRegistre:data[0].id})
    } catch (error) {
    console.log(error);
    }
  };

  useEffect(() =>{
      fetchStatus();
  }, []);



  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setFinans({...finans, [name]: value });
  };
 
  const handleSubmit = async event => {
    event.preventDefault();
    
     try {
      const response = await axios
      .post("http://localhost:8000/api/ressources/inscription",
    {...finans,  
      statutRegistre:`/api/registats/${finans.statutRegistre}`,
      bailleurFonds:`/api/bailleurs/${finans.bailleurFonds}`,
      exerciceRegistre:`/api/registres/${finans.exerciceRegistre}`
   }
    );
      console.log(response.data);
  } catch(error) {
   console.log(error.response)
   setErrors("Informations incorrectes")
  }
}; 

    return (
    <section id="exp">
      <div className="product-detail-page">
      <h4 className="card-header">
            <div className="row">
            <div className="text-left col-sm-8">
            Ressource financière
            </div>
            <OuvriExerc/>
            </div>
          </h4>
          <ul className="nav nav-tabs md-tabs tab-timeline" role="tablist">
            <li className="nav-item">
              <a
               className="nav-link active f-18 p-b-0"
                href="#/sbu/ressources/new"
              >
                Inscription
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                className="nav-link f-18 p-b-0"
                href="#/sbu/financements"
              >
                Actualisation
              </a>
              <div className="slide" />
            </li>
            <li className="nav-item m-b-0">
              <a
                 className="nav-link f-18 p-b-0"
                 href="#/sbu/ressources"
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

      <form onSubmit={handleSubmit} >
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Bailleur *</label>
                </div>
             <div className="col-sm-2">
                    <select 
                    id="bailleurFonds"
                    onChange={handleChange} 
                    name="bailleurFonds"
                    value={finans.bailleurFonds}
                    className={"form-control" + (error && " is-invalid")}
                   > <option value="">Choisir ...</option>
                     {bailleurs.map(bailleur => <option key={bailleur.id} value={bailleur.id}>
                       {bailleur.sigleBailleur}
                     </option>)}
                      </select>
                     </div>
                <div className="col-sm-1">
                  <label className="col-form-label">Objet *</label>
                </div>
                <div className="col-sm-3">
                  <select 
                  name="objetFinancement"
                  className="form-control"
                  value= {finans.objetFinancement}
                  onChange={handleChange}
                  >
                    <option value="Fonctionnement">Fonctionnement</option>
                    <option value="Investissement">Investissement</option>
                  </select>
                </div>
                <div className="col-sm-1">
                  <label className="col-form-label">Mode *</label>
                </div>
                <div className="col-sm-3">
                  <select 
                  name="modeFinancement"
                   value={finans.modeFinancement}
                  onChange={handleChange}
                  className="form-control">
                    <option value="Subvention">Subventions</option>
                    <option value="Dotation">Dotations</option>
                    <option value="Emprunts">Emprunts</option>
                    <option value="Recette propres">Recette propres</option>
                    <option value="Dons">Dons</option>
                  </select>
                </div>
                </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Montant * (FCFA)</label>
                </div>
                <div className="col-sm-3">
                  <input 
                  id="montantFinancement"
                  type="number"
                  name="montantFinancement"
                  value={finans.montantFinancement}
                  onChange={handleChange}
                  className={"form-control" + (error && " is-invalid")} />
                </div>
                     <div className="col-sm-1">
                  <label className="col-form-label">Statut </label>
                </div>
               <div className="col-sm-3">
                    <select 
                  disabled="disabled"
                   id="statutRegistre"
                    onChange={handleChange} 
                    name="statutRegistre"
                    value={finans.statutRegistre}
                    className={"form-control" + (error && " is-invalid")}
                   >
                     {status.map(statu => <option key={statu.id} value={statu.id}>
                       {statu.statut}
                     </option>)}
                      </select>
                     </div>
                     <div className="col-sm-1">
                  <label className="col-form-label">Exercice </label>
                </div>
               <div className="col-sm-2">
                    <select 
                  disabled="disabled"
                  id="exerciceRegistre"
                    onChange={handleChange} 
                    name="exerciceRegistre"
                    value={finans.exerciceRegistre}
                    className={"form-control" + (error && " is-invalid")}
                   >
                     {status.map(exerc => <option key={exerc.id} value={exerc.id}>
                       {exerc.exerciceRegistre.anneeExercice}
                     </option>)}
                      </select>
                     </div>
              </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Description</label>
                </div>
                <div className="col-sm-10">
                  <textarea
                    onChange={handleChange} 
                    name="descriptionFinancement"
                    id="descriptionFinancement"
                    value={finans.descriptionFinancement}
                    type="text"
                    className="form-control"
                  />
                </div>
              </div>
              <div className="text-right col-sm-12">
                <button type="submit" className="btn btn-primary">
                {(!editing && <>Inscrire</>) || (<>Modifier</>)}
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

export default InscriRessource;