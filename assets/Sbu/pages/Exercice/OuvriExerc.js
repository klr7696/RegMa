import axios from "axios";
import React, {useState, useEffect} from "react";

const OuvriExerc = () => {
  const [exers, setExers] = useState([]);
    
  const fetchExer = async () => {

    try{
  const data = await axios
  .get("http://localhost:8000/api/registres/ouvert?estEnCours=true&exerciceRegistre.estOuvert=true")
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
        <div className="text-right col-sm-12">
                  <select 
                  disabled="disabled"
                  name="exerciceRegistre"
                  className="text-center p-10 form-control bg-success"
                 // className={"text-center p-10 form-control" + (exers="Primitif" && "bg-success") +
                //  (exers="Supplémentaire" && "bg-danger")}
                >
                 {exers.map(exer => 
                 <option key={exer.id} value={exer.id}>
                Exercice {exer.statut} {exer.exerciceRegistre.anneeExercice}
               </option>)}  
                  </select>
          </div>
  );
};

export default OuvriExerc ;
