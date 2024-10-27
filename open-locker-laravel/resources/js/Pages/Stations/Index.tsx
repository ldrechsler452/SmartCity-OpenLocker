import NavLink from '@/Components/NavLink';
import PrimaryButton from '@/Components/PrimaryButton';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Station } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import { useState } from 'react';
import { PiLockersLight } from 'react-icons/pi';
import Select, { ActionMeta, SingleValue } from 'react-select';

export default function Stations({ stations }: { stations: Station[] }) {
    const user = usePage().props.auth.user;

    const [filteredStations, setFilteredStations] = useState(stations);
    const [selectedOption, setSelectedOption] = useState<SingleValue<{ value: string; label: string }>>(null);

    const uniqueContentNames = Array.from(new Set(stations.flatMap(station =>
        station.lockers.flatMap(locker => locker.content.name)
    )));
    const options = uniqueContentNames.map((name: string) => ({ value: name, label: name }));

    function handleSelectionChange(newValue: SingleValue<{ value: string; label: string; }>, actionMeta: ActionMeta<{ value: string; label: string; }>): void {
        setSelectedOption(newValue);
        if (newValue) {
            setFilteredStations(stations.filter(station => station.lockers.some(locker => locker.content.name === newValue.value)));
        } else {
            setFilteredStations(stations);
        }
    }

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Stations
                </h2>
            }
        >
            <Head title="Stations" />

            <div className="py-0 sm:py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className='flex flex-col gap-4'>
                                <div className="flex gap-4">
                                    <h3 className="text-xl font-bold">Filter</h3>
                                    <Select
                                        className="flex-grow"
                                        options={options}
                                        getOptionLabel={(option) => option.label}
                                        getOptionValue={(option) => option.value}
                                        isClearable
                                        isSearchable
                                        defaultValue={selectedOption}
                                        onChange={handleSelectionChange}
                                    />
                                </div>
                                {filteredStations.map((station) => (
                                    <div key={station.id} className="w-100 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex gap-2">
                                        <div className="flex-grow">
                                            <Link href={`/stations/${station.id}/lockers`}>
                                                <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{station.name}</h5>
                                            </Link>
                                            <div className="grid grid-cols-[auto_1fr] gap-4">
                                                <div>Adresse:</div>
                                                <div>{station.address}</div>
                                                <div>Entfernung:</div>
                                                <div>{station.distance} km</div>
                                            </div>
                                        </div>
                                        <div className="w-2/5">
                                            <img src={station.image} alt={`${station.name} image`} className="object-cover h-full w-full" />
                                        </div>
                                    </div>)
                                )}
                                <div className="pb-4 flex justify-center">
                                    <Link
                                        href={route('stations.create')}
                                    >
                                        <PrimaryButton className="flex gap-4">
                                            <PiLockersLight />
                                            Station erstellen
                                        </PrimaryButton>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
