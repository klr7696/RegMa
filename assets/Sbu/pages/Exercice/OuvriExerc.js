import axios from "axios";
import React, {useState, useEffect} from "react";

const OuvriExerc = () => {
  const [exers, setExers] = useState([]);
    
  const fetchExer = async () => {

    try{
  const data = await axios
  .get("http://localhost:8000/api/registats/registre_ouvert")
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
           <div className="text-left col-sm-4">
                  <select 
                  disabled="disabled"
                  name="exerciceRegistre"
                  className="text-center p-10 form-control form-control-bold bg-success"
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
