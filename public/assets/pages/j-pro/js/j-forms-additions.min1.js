import axios from "axios";

$(document).ready(function () {

  const [finans, setFinans] = useState([]);
    
  const fetchFinans = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/bailleurs/actifressource?associationRessource.estValide=true")
  .then(bailleur => bailleur.data["hydra:member"])
  .then(objet => objet.data["hydra:member"][0]["associationRessource"]);
    setFinans(data);
    } catch (error) {
    console.log(error.response);
    }
  };


  useEffect(() =>{
      fetchFinans();
  }, []);

  const [fina, setFina] = useState([]);
    
  const fetchFinans = async () => {
    try{
  const data = await axios
  .get("http://localhost:8000/api/bailleurs/actifressource?associationRessource.estValide=true")
  .then(objet => objet.data["hydra:member"][0]["associationRessource"]);
    setFina(data);
    } catch (error) {
    console.log(error.response);
    }
  };


  useEffect(() =>{
      fetchFina();
  }, []);

  ($bailleurs = finans),
  ($objets = fina),
    $("#bailleur").change(function () {
      if (
        ($("#bailleur-objet option").length && $("#bailleur-objet option:gt(0)").remove(),
        $("#bailleur-objet-color option").length &&
          $("#bailleur-objet-color option:gt(0)").remove(),
        $("#bailleur option:selected").each(function () {
          $bailleur_val = $(this).val();
        }),
        ($bailleur = $objets[$bailleur_val]))
      )
        for ($i = 0; $i < $bailleur.length; $i++)
          ($opt = '<option value="' + $bailleur[$i] + '">' + $bailleur[$i] + "</option>"),
            $("#bailleur-objet").append($opt);
    })
      .change();
});
