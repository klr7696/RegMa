import axios from "axios";
import React, {useState, useEffect} from "react";
import { toast } from "react-toastify";

const OuvriExerc = () => {

  const [ouvrs, setOuvrs] = useState({
    statut: "Primitif",
    exerciceRegistre: ""
  });

  const [exercs, setExercs] = useState([]);
    
  const fetchExercs = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/registres?estOuvert=false&estCloture=false")
  .then(response => response.data["hydra:member"]);
    setExercs(data);
    if (!ouvrs.exerciceRegistre) setOuvrs({...ouvrs, exerciceRegistre:data[0].id} )
    } catch (error) {
    console.log(error);
    }
  };

  useEffect(() =>{
      fetchExercs();
  }, []);


  const [error, setError] = useState("");

  const handleChange = ({ currentTarget }) => {
    const { name, value } = currentTarget;
    setOuvrs({...ouvrs, [name]: value });
  };
 
  const handleSubmit = async event => {
    event.preventDefault();

    try {
      const response = await axios
      .post("http://localhost:8000/api/registats", {...ouvrs,
      exerciceRegistre:`/api/registres/${ouvrs.exerciceRegistre}`})
       if(ouvrs.exerciceRegistre){
        await axios.patch("http://localhost:8000/api/registres/ouvre/" + ouvrs.exerciceRegistre , {});
        }
      console.log(response.data);
      toast.success("Exercice est ouvert avec succès")
    } catch(error) {
      console.log(response.error);
     setError("Informations incorrectes")
    }
   
  };

  return (
   <div className="page-body">
        <form onSubmit={handleSubmit}>
      
          <div className="row form-group">
          <div className="col-sm-4">
              <label className="col-form-label">Registre</label>
            </div>
              <div className="col-sm-8">
              <select 
              onChange={handleChange} 
              name="exerciceRegistre"
              id="exerciceRegistre"
              value={ouvrs.exerciceRegistre}
              className={"form-control" + (error && " is-invalid")}
             >
               {exercs.map(exerc => <option key={exerc.id} value={exerc.id}>
                 {exerc.anneeExercice}
               </option>)}
                </select>
              </div>
        </div>
        
        <div className="row form-group">
          <div className="col-sm-4">
            <label className="col-form-label">Status </label>
          </div>
          <div className="col-sm-8">
            <input
              name="statut"
              id="statut"
              type="text"
              className={"form-control required" + (error && " is-invalid")}
              value={ouvrs.statut}
              onChange={handleChange}
            //  disabled="disabled"
            />
            {error && <p className="invalid-feedback">{error}</p>}
          </div>
          </div>
        <div className="text-right col-sm-12">
          <button 
          type="submit" 
          className="btn btn-primary">
            Ouvrir
          </button>
        </div>
      </form>
  </div>
  );
};

export default OuvriExerc ;
