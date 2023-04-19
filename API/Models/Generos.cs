using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace API.Models
{
    [Table("Generos")]
    public class Generos
    {
        [Key]
        public int IdGenero { get; set; }
        public string Genero { get; set; }
    }
}
