import axios from "axios";
import React, {useState, useEffect} from "react";

const OuvriExerc = () => {
  const [exers, setExers] = useState({
    statut:""
  });
    
  const fetchExer = async () => {

    try{
  const data = await axios
  .get("http://localhost:8000/api/registat/actif?estEncours=true&exerciceResgistre.estOuvert=true")
  //.then(reponse => console.log(reponse));
  .then(response => response.data['hydra:member'])
   setExers(data);
    } catch (error) {
    console.log(error.data);
    }
  };
  useEffect(() =>{
    fetchExer();
}, []);


  return (
   <div>
         <h3 className="card-header">
        <div className="row">
        <div className="text-left col-sm-7">
        EXERCICE
        </div>
        <div className="text-right col-sm-5 waves-effect waves-light p-b-10">
                  <select 
                  disabled="disabled"
                  name="exerciceRegistre"
                  className={"text-center p-10 form-control" + (exers.statut="Primitif" && "bg-success") +
                  (exer.statut="Supplémentaire" && "bg-danger")
                  }>
                 {exers.map(exer => 
                 <option key={exer.id} value={exer.id}>
                Exercice {exer.statut} {exer.exerciceRegistre.anneeExercice}
               </option>)}  
                  </select>
          </div>
        </div>
      </h3>
  </div>
  );
};

export default OuvriExerc ;
