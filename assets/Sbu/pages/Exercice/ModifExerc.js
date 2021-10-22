import axios from "axios";
import React, {useState, useEffect} from "react";

const ModifExerc = () =>{

  const [exercs, setExercs] = useState({
    AnneeExercice: "2019",
    ordonateurExercice: "Borahima",
    dateVote: "",
    dateAdoption: "2019-10-10",
    description: "",
    nomenclature: "/api/nomenclatures/16"
  });
  const [nomenclatures, setNomens] = useState([]);
    
  const fetchNomen = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/nomenclatures?estActif=true")
  .then(response => response.data["hydra:member"]);
    setNomens(data);
    if (!chaps.nomenclature) setChaps({...chaps, nomenclature:data[0].id} )
    } catch (error) {
    console.log(error.response);
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
     await axios
      .post("http://localhost:8000/api/registres", exercs)
      console.log(response.data);
    } catch(error) {
      console.log(error.response);
     setError("Informations incorrectes")
    }
   
  };

  <div className="page-body">
      <div className="row">
        <div className="col-sm-12">
          <div className="card-block">
            <form>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Type de modification *</label>
                </div>
                <div className="col-sm-3">
                  <select className=" form-control">
                    <option value="1">Decision modificative</option>
                    <option value="2">Supplementaire</option>
                  </select>
                  </div>
                  <div className="col-sm-2">
                  <label className="col-form-label">Nombre de modification</label>
                </div>
                  <div className="col-sm-2">
                    <input type="text" className="form-control" placeholder="1" />
                  </div>
                </div>
              <div className="row form-group">
                <div className="col-sm-2">
                  <label className="col-form-label">Date d'approbation *</label>
                </div>
                <div className="col-sm-3">
                  <input type="date" className="form-control" />
                </div>
                <div className="col-sm-2">
                  <label className="col-form-label">
                    Motif de modification *
                  </label>
                </div>
                <div className="col-sm-5">
                  <textarea type="text" className="form-control" />
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
};

export default ModifExerc ;
