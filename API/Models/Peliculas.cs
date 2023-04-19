using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace API.Models
{
    [Table("Peliculas")]
    public class Peliculas
    {
        [Key]
        public int IdPelicula { get; set; }
        public string Titulo { get; set; }
        public DateTime Año { get; set; }
        public string NombreDirector{ get; set; }
        public string ApellidoDirector { get; set; }
        public int IdGenero { get; set; }
        public int IdImagen { get; set; }
        public int IdPersona { get; set; }

        [ForeignKey("IdGenero")]
        public virtual Generos Genero { get; set; }

        [ForeignKey("IdImagen")]
        public virtual Imagen Imagen { get; set; }

        [ForeignKey("IdPersona")]
        public virtual  Personas Persona { get; set; }
    }
}
