using API.Context;
using API.Exceptions;
using API.Interface;
using API.Models;
using Microsoft.AspNetCore.Mvc;

namespace API.Services
{
    public class PersonasService : IPersonas
    {
        public PFCatalogoContext _context { get; set; }
        public PersonasService(PFCatalogoContext context)
        {
            _context = context;
        }
        public IQueryable<Personas> GetAll()
        {
            return _context.Personas;
        }
        public IQueryable<Personas> GetPorCorreo(string correo, string contrasena)
        {
            Personas person = _context.Personas.FirstOrDefault(p => p.Correo == correo && p.Contraseña == contrasena);
            try
            {
                if (person != null)
                {
                    return _context.Personas.Where(p => p.Correo == correo && p.Contraseña == contrasena);
                }
                else
                {
                    throw new GeneralExeption("Este usuario no existe");
                }
            }
            catch (GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                throw;
            }
            
        }
        public IQueryable PostPersona(Personas person)
        {
            try
            {
                List<Personas> persona = new List<Personas>();
                persona = GetAll().ToList();
                Personas per = new Personas();
                per = persona.Find(d => d.Correo == person.Correo);
                if (per == null)
                {
                    _context.Personas.Add(person);

                    _context.SaveChanges();
                }
                else
                {
                    throw new GeneralExeption("Este correo ya esta registrado ");
                }
                    
            }
            catch (GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                throw;
            }

            return _context.Personas.Where(p => p.Correo == person.Correo);
        }
    }
}
