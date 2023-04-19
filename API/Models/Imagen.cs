using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace API.Models
{
    [Table("Imagen")]
    public class Imagen
    {
        [Key]
        public int IdImagen { get; set; }
        public string Ruta { get; set; }
        public string Nombre { get; set; }

    }
}
