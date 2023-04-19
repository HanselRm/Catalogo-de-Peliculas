using API.Models;
using Microsoft.AspNetCore.Mvc;

namespace API.Interface
{
    public interface IPersonas
    {
        public IQueryable<Personas> GetAll();
        public IQueryable<Personas> GetPorCorreo(string correo, string contrasena);
        public IQueryable PostPersona(Personas person); 


    }
}
