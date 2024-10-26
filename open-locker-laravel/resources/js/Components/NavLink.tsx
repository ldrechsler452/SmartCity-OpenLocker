import { InertiaLinkProps, Link } from '@inertiajs/react';
import { ReactNode } from 'react';

interface NavLinkProps extends InertiaLinkProps {
    active: boolean;
    icon?: ReactNode;
}

export default function NavLink({
    active = false,
    className = '',
    children,
    icon,
    ...props
}: NavLinkProps) {
    return (
        <Link
            {...props}
            className={
                'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-extrabold leading-5 transition duration-150 ease-in-out focus:outline-none ' +
                (active
                    ? 'border-indigo-400 text-white focus:border-indigo-700 dark:border-indigo-600 dark:text-gray-100'
                    : 'border-transparent text-gray-100 hover:border-gray-300 hover:text-gray-700 focus:border-gray-300 focus:text-gray-700 dark:text-gray-400 dark:hover:border-gray-700 dark:hover:text-gray-300 dark:focus:border-gray-700 dark:focus:text-gray-300') +
                className
            }
        >
            {icon && <span className="mr-2 text-xl">{icon}</span>}
            {children}
        </Link>
    );
}
