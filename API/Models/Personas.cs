using System.ComponentModel.DataAnnotations;

namespace API.Models
{
    public class Personas
    {
        [Key]
        public int IdPersona { get; set; }
        public String Nombre { get; set; }
        public String Apellido { get; set; }
        public String Correo { get; set; }
        public String Contraseña { get; set; }
    }
}
