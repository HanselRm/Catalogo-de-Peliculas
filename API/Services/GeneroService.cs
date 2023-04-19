using API.Context;
using API.Exceptions;
using API.Interface;
using API.Models;
using System;
using System.Linq;

namespace API.Services
{
    public class GeneroService : IGenero
    {
        PFCatalogoContext _context;
        public GeneroService(PFCatalogoContext context)
        {
            _context = context;
        }

       

        public IQueryable<Generos> GetAll()
        {
            return _context.Generos;
        }

        public IQueryable getId(int id)
        {
            try
            {
                if (_context.Generos.Where(g => g.IdGenero == id).Count() != 0)
                {
                    return _context.Generos.Where(g => g.IdGenero == id);
                }
                else
                {
                    throw new GeneralExeption("Este genero no existe");
                }
            }
            catch (GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                throw;
            }
        }

        public IQueryable PostGenero(Generos genero)
        {
            try
            {
                List<Generos> gener = new List<Generos>();
                gener = GetAll().ToList();
                Generos ge = new Generos();
                ge = gener.Find(d => d.Genero == genero.Genero);
                if (ge == null)
                {
                    _context.Generos.Add(genero);

                    _context.SaveChanges();
                }
                else
                {
                    throw new GeneralExeption("Este genero ya esta registrado");
                }

            }
            catch (GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                throw;
            }
            return _context.Generos;
        }

        public IQueryable PutGenero(int id, Generos genero)
        {
            var generoexistente = _context.Generos.Find(id);

            try
            {
                if (generoexistente == null)
                {
                    throw new GeneralExeption("Este genero no existe");
                }
                else
                {
                    generoexistente.Genero = genero.Genero;
                    _context.SaveChanges();

                    return _context.Generos;
                }
            }
            catch (GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                throw;
            }
        }

        public IQueryable DeleteGenero(int id)
        {
            var generoBorrar = _context.Generos.Find(id);

            try
            {
                if (generoBorrar == null)
                {
                    throw new GeneralExeption("Este genero no existe");
                }
                else
                {
                    _context.Generos.Remove(generoBorrar);
                    _context.SaveChanges();
                    return _context.Generos;
                }
            }
            catch (GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                throw;
            }
        }
    }
}
