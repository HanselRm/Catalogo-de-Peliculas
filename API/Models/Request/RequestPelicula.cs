using System.ComponentModel.DataAnnotations.Schema;

namespace API.Models.Request
{
    public class RequestPelicula
    {
        public int IdPelicula { get; set; }
        public string Titulo { get; set; }
        public DateTime Año { get; set; }
        public string NombreDirector { get; set; }
        public string ApellidoDirector { get; set; }
        public int IdGenero { get; set; }
        public int IdPersona { get; set; }

    }
}
