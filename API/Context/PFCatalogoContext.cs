using API.Models;
using Microsoft.EntityFrameworkCore;
using System.Data;

namespace API.Context
{
    public class PFCatalogoContext : DbContext
    {
        public PFCatalogoContext(DbContextOptions<PFCatalogoContext> op) : base(op) 
        {}

        public DbSet<Generos> Generos { get; set; }
        public DbSet<Peliculas> Peliculas { get; set;}
        public DbSet<Personas> Personas { get; set; }
        public DbSet<Imagen> Imagen { get; set; }

    }
}
